<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-6">
        <?= form_open('buy', 'class="row g-3"') ?>

<?= form_hidden('username', session()->get('username')) ?>

<!-- FIX: form_hidden tidak boleh pakai array -->
<input type="hidden" name="total_harga" id="total_harga" value="">

<div class="col-12">
    <?= form_label('Nama', 'nama', ['class' => 'form-label']) ?>
    <?= form_input([
        'name'     => 'nama',
        'id'       => 'nama',
        'class'    => 'form-control',
        'value'    => session()->get('username'),
        'readonly' => true]) ?>
</div>

<div class="col-12">
    <?= form_label('Alamat', 'alamat', ['class' => 'form-label']) ?>
    <?= form_input([
        'name'  => 'alamat',
        'id'    => 'alamat',
        'class' => 'form-control']) ?>
</div> 

<div class="col-12"> 
    <?= form_label('Kelurahan', 'kelurahan', ['class' => 'form-label']) ?>
    
    <!-- FIX dari strong ke select agar tidak error logic -->
    <?= form_dropdown('kelurahan', [], '', ['id' => 'kelurahan', 'class' => 'form-control']) ?>

</div>

<div class="col-12"> 
    <?= form_label('Layanan', 'layanan', ['class' => 'form-label']) ?> 

    <!-- FIX -->
    <?= form_dropdown('layanan', [], '', ['id' => 'layanan', 'class' => 'form-control']) ?>

</div>

<div class="col-12">
    <?= form_label('Ongkir', 'ongkir', ['class' => 'form-label']) ?>
    <?= form_input([
        'name'     => 'ongkir',
        'id'       => 'ongkir',
        'class'    => 'form-control',
        'readonly' => true]) ?>
</div>

<div class="col-12">
    <?= form_submit(
        'submit',
        'Buat Pesanan',
        ['class' => 'btn btn-primary']) ?>
</div>

<?= form_close() ?> 
    </div>

    <div class="col-lg-6">
        <table class="table">
  <thead>
      <tr>
          <th scope="col">Nama</th>
          <th scope="col">Harga</th>
          <th scope="col">Jumlah</th>
          <th scope="col">Sub Total</th>
      </tr>
  </thead>

  <tbody>
      <?php 
      if (!empty($items)) :
          foreach ($items as $index => $item) :
      ?>
              <tr>
                  <td><?= $item['name'] ?></td>
                  <td><?= number_to_currency($item['price'], 'IDR') ?></td>
                  <td><?= $item['qty'] ?></td>
                  <td><?= number_to_currency($item['price'] * $item['qty'], 'IDR') ?></td>
              </tr>
      <?php
          endforeach;
      endif;
      ?>

      <tr>
          <td colspan="2"></td>
          <td>Subtotal</td>
          <td><?= number_to_currency($total, 'IDR') ?></td>
      </tr>

      <tr>
          <td colspan="2"></td>
          <td>Total</td>
          <td><span id="total"><?= number_to_currency($total, 'IDR') ?></span></td>
      </tr>

  </tbody>
</table>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
$(document).ready(function() {

    let ongkir = 0;
    let subtotal = <?= $total ?>;

    hitungTotal();

    function hitungTotal() {
        let total = subtotal + ongkir;

        $("#ongkir").val(ongkir);
        $("#total").text(`IDR ${total.toLocaleString('id-ID')}`);
        $("#total_harga").val(total);
    }

    $('#kelurahan').select2({
        placeholder: 'Cari daerah tujuan',
        minimumInputLength: 3,
        width: '100%',

        ajax: {
            url: '<?= site_url('ajax/destinations') ?>',
            dataType: 'json',
            delay: 300,

            data: function(params) {
                return {
                    q: params.term
                };
            },

            processResults: function(data) {
                return {
                    results: data.results
                };
            },

            cache: true
        }
    });

    // PINDAHKAN KE SINI
    $('#kelurahan').on('select2:select', function (e) {

    let id_kelurahan = e.params.data.id;

    console.log("ID Kelurahan:", id_kelurahan);

    $("#layanan").empty();

    ongkir = 0;
    hitungTotal();

    $.ajax({
        url: "<?= site_url('ajax/costs') ?>",
        type: "GET",
        dataType: "json",
        data: {
            destination: id_kelurahan
        },
        success: function(data) {

            console.log(data);

            $("#layanan").append(
                '<option value="">-- Pilih Layanan --</option>'
            );

            data.forEach(function(item) {

                $("#layanan").append(
                    `<option value="${item.cost}">
                        ${item.description} (${item.service}) - ${item.etd}
                    </option>`
                );

            });

        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });

});
$("#layanan").on('change', function() {
    ongkir = parseInt($(this).val());
    hitungTotal();
}); 
});
</script>
<?= $this->endSection() ?>