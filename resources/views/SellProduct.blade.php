@extends('master')
@section('content')

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/sell_product.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Update a product</title>

  </head>
  <body>
    @if(session('error'))
              <div class="alert alert-danger alert-block">
                {{ session('error') }}
              </div>
              @endif


              @if(session('success'))
              <div class="alert alert-success alert-block">
                {{ session('success') }}
              </div>
              @endif
<!--body-->
<section>
    <div class="container">
      <div class="user singupBx">
        <div class="formBx">
          <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <h2>Update a product</h2>
            <br>
            <div>
            <h6>Title</h6><p style="font-size: 12px">*max 75 characters</p></div>
            <input type="text" name="title" placeholder="Title">
            
             <h6>Type</h6>
             <select id="drop-down" name="type" class="browser-default custom-select">
                <option selected="" ></option>
                <option value="Shirt">Shirt</option>
                <option value="Pants">Pants</option>
                <option value="Jacket">Jacket</option>
                <option value="Others">Others</option>
                <!-- <option value="3">Category</option> -->
              </select>

             <h6>Condition</h6>
             <select id="drop-down" name="condition" class="browser-default custom-select">
              <option selected="" ></option>
              <option value="New">New</option>
              <option value="Used">Used</option>
              <!-- <option value="3">Category</option> -->
            </select>
            <h6>Location</h6>
            <select id="drop-down" name="location" class="browser-default custom-select">
             <option selected="" ></option>
             <option value="Jabodetabek">Jabodetabek</option>
             <option value="Denpasar">Denpasar</option>
             <option value="Surabaya">Surabaya</option>
             <!-- <option value="3">Category</option> -->
           </select>
            <h6>Description</h6>
            <textarea rows="2" name="description" cols="25" placeholder="Description"></textarea>

             <div class="form-group">
            <h6>Price</h6>
            <div class="price">
  <h6>IDR (Indonesian rupiah)</h6>
  <input class="pricetag input-currency" type="text" type-currency="IDR" name="price" placeholder="Price">
  <!-- <input class="input-currency" type="text" type-currency="IDR" placeholder="Rp" /> -->
</div>
</div>
            <!-- @livewireScripts -->
            <script>
  document.querySelectorAll('input[type-currency="IDR"]').forEach((element) => {
  element.addEventListener('keyup', function(e) {
  let cursorPostion = this.selectionStart;
    let value = parseInt(this.value.replace(/[^,\d]/g, ''));
    let originalLenght = this.value.length;
    if (isNaN(value)) {
      this.value = "";
    } else {    
      this.value = value.toLocaleString('id-ID', {
        currency: 'IDR',
        style: 'currency',
        minimumFractionDigits: 0
      });
      cursorPostion = this.value.length - originalLenght + cursorPostion;
      this.setSelectionRange(cursorPostion, cursorPostion);
    }
  });
});
</script>
                <!-- <div class="col-xs-12 col-sm-12 col-md-12"> -->
            <div class="form-group">
                <h6>Image</h6>
                <input type="file" name="image" placeholder="image">
            </div>
          <!-- </div> -->

            <input type="submit" name="" value="Update">
         
          </form>
        </div>
      </div>
    </div>
  </section>

  


</body>
</html>

@endsection