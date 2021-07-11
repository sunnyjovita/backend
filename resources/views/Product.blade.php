
<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel 5.6 - CRUD Operations using Laravel Ajax</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/css/product.css">
 </head>
 <body>
  <div class="container">    
     <br />
     <h3 align="center">Laravel 5.6 Ajax Crud</h3>
     <br />
     <div align="left">
      <h6>Sunny Jovita</h6>
      <h6> Laravel versi 5.6 </h6>
      <h6> PHP versi 7.1.3 </h6>
     </div>
     <div align="right">
      <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
     </div>
     
     <br />
   <div class="table-responsive">
    <table class="table table-bordered table-striped" id="user_table">
           <thead>
            <tr>
                <th width="10%">Image</th>
                <th width="35%">Title</th>
                <th width="35%">Price</th>
                <th width="30%">Action</th>
            </tr>
           </thead>
       </table>
   </div>
   <br />
   <br />
  </div>



<div id="formModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Record</h4>
        </div>
        <div class="modal-body">
         <span id="form_result"></span>
         <form  id="sample_form" class="form-horizontal" enctype="multipart/form-data">
          @csrf
          
           <div class="form-group">
                <label class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" value="">
                    </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Price</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control pricetag input-currency" type-currency="IDR" name="price" placeholder="Enter price" value="" id="price">
                </div>
            </div>

            <script>
                document.querySelectorAll('input[type-currency="IDR"]').forEach((element) => {
                    element.addEventListener('keyup', function(e) {
                        let cursorPostion = this.selectionStart;
                        let value = parseInt(this.value.replace(/[^,\d]/g, ''));
                        let originalLenght = this.value.length;

                        if (isNaN(value)) {
                            this.value = "";
                        }
                        else {    
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

            <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <textarea rows="2" id="description" class="form-control" name="description" placeholder="Enter description"></textarea>
                    </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Image</label>
                     <div class="col-sm-10">
                        <input type="file" id="image" class="form-control" name="image" placeholder="image">
                        <div id="preview"><img id="editImage" src="" /></div><br>
                        <span id="store_image"></span>
                     </div>
            </div>

           <br />
           <div class="form-group" align="center">
            <input type="hidden" name="action" id="action" />
            <input type="hidden" name="hidden_id" id="hidden_id" />
            <!-- <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" /> -->
            <input type="button" name="action_button" id="action_button" class="btn btn-primary" value="Save product">
           </div>
         </form>
        </div>
     </div>
    </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmation</h2>
            </div>
            <div class="modal-body">
                <h4 id="deleteMess" align="center" style="margin:0;">Are you sure you want to remove this product?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){



 $('#user_table').DataTable({
  processing: true,
  serverSide: true,
  ajax:{
   url: "{{ route('api.getProduct') }}",
  },
  columns:[
   {
    data: 'image',
    name: 'image',
    render: function(data, type, full, meta){
     return "<img src={{ URL::to('/') }}/storage/" + data + " width='70' class='img-thumbnail' />";
    },
    orderable: false
   },
   {
    data: 'title',
    name: 'title'
   },
   {
    data: 'price',
    name: 'price'
   },
   {
    data: 'action',
    name: 'action',
    orderable: false
   }
  ]
 });

 $('#create_record').click(function(){
  $('.modal-title').text("Add New Record");
     $('#action_button').val("Add");
     $('#action').val("Add");
     $('#formModal').modal('show');
    $('#form_result').html('');

 });


 $("#action_button").on('click', function(event){

    
  let formData = new FormData();
  let image = $("#image")[0].files[0];
  formData.append('image', image);


  // console.log(image);

 
  let result = $('#sample_form').serializeArray();


for(let elm of result){
    formData.append(elm.name, elm.value);
}

  // result.forEach(elm=>{
  //   formData.append(elm.name, elm.value);
  // })

  // console.log(result);


  
  // console.log(formData);
  //to see formdata
  for (var pair of formData.entries()) {
    console.log(pair[0]+ ', ' + pair[1]); 
    }

  if($('#action').val() == 'Add')

  {
   $.ajax({
    url:"{{ route('api.postProduct') }}",
    type:"POST",
    processData: false,
    contentType: false,
    data: formData,
    dataType:"json",
    success: function(data)
    {
    // console.log(data.status);
     let html = '';
     if(data.status == 'error')
     {
      let l = Object.keys(data.message).length;
      // console.log(l);
      let objToarry = Object.keys(data.message);
      // console.log(objToarry[0]);
      html = '<div class="alert alert-danger">';
      for(var count = 0; count < l; count++)
      {
        // console.log(objToarry[count]);
        let a = objToarry[count];
       html += '<p>' + data.message[a][0] + '</p>';
      }
      
      html += '</div>';
      // console.log(data);
      // console.log(data.message);

     }
     if(data.status == 'success')
     {
  
      html = '<div class="alert alert-success">' + data.message + '</div>';
      $('#sample_form')[0].reset();
      $('#user_table').DataTable().ajax.reload();
     }
     $('#form_result').html(html);
    }
   })
  }

  if($('#action').val() == "Edit")
  {

    // console.log(formData);


   $.ajax({
    url:"{{ route('api.updateProduct') }}",
    type:"POST",
    data:formData,
    contentType: false,
    cache: false,
    processData: false,
    dataType:"json",
    success:function(data)
    {
     let html = '';
     if(data.status == 'error')
     {

if(data.message == "Image is not an image"){
    
    html = '<div class="alert alert-danger">';
     
    html += '<p>' + data.message + '</p>';
      
}
else{


        let l = Object.keys(data.message).length;
      
      let objToarry = Object.keys(data.message);
      
      html = '<div class="alert alert-danger">';
      for(var count = 0; count < l; count++)
      {
      
        let a = objToarry[count];
       html += '<p>' + data.message[a][0] + '</p>';
      }
      
     
      html += '</div>';

     }
 }
     if(data.status == 'success')
     {
      html = '<div class="alert alert-success">' + data.message + '</div>';
      $('#sample_form')[0].reset();
      // $('#store_image').html('');
      $('#user_table').DataTable().ajax.reload();
     }
     $('#form_result').html(html);
    }
   });
  }
 });

 $(document).on('click', '.edit', function(){
  let hid_id = $(this).data('id');
  // console.log(hid_id);
  $('#form_result').html('');

    var url = '{{ route("api.getById", ":id") }}';
    url = url.replace(':id', hid_id )

  $.ajax({
   url:url,
   dataType:"json", // get data in json format in server side
   success:function(d)
   { // will be called if it's success
    console.log(d);
    $('#title').val(d.title);
    $('#price').val(d.price);
    $('#description').val(d.description);
    $('#editImage').attr("src","{{ URL::to('/') }}/storage/" + d.image);
    $('#hidden_id').val(d.id);
    $('.modal-title').text("Edit New Record");
    $('#action_button').val("Edit");
    $('#action').val("Edit");
    $('#formModal').modal('show');
   }
  })
 });

 var user_id;

$(document).on('click', '.delete', function(){
  user_id = $(this).data('id');
  $('#confirmModal').modal('show');
 });

$('#ok_button').click(function(){

    var url = '{{ route("api.deleteProduct", ":id") }}';
    url = url.replace(':id', user_id )

  $.ajax({
   url:url,
   type: "DELETE",
   beforeSend:function(){
    $('#ok_button').text('Deleting...');
   },
   success:function(data)
   {
    if(data.status == "success"){

     html = '<div class="alert alert-success">' + data.message + '</div>';

      $('#deleteMess').html(html);
      $('#user_table').DataTable().ajax.reload();
     
    }
    setTimeout(function(){
    
     $('#confirmModal').modal('hide');
     $('#user_table').DataTable().ajax.reload();

    }, 1500);
      
   }

  })
 });

});
</script>

</body>
</html>

