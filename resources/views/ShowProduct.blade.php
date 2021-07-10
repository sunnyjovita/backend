 <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1">
    <title>My products</title>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="/css/product.css">



</head>
 
<body style="height: 100%; ">
    <section>
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h2>My products</h2>
            </div>
            <div class="pull-right">
                      <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>

                <!-- <button type="button" class="btn btn-success" id="btn-create" name="btn-create">Create New Product</button> -->
            </div>
        </div>
    </div>


    <table class="table table-bordered" id="product_table">
        <tr>
            <!-- <th>No</th> -->
            <th>Image</th>
            <th>Title</th>
            <th>Price</th>
            <th>Action</th>
            <!-- <th width="10%">Image</th>
                <th width="35%">Title</th>
                <th width="35%">Price</th>
                <th width="30%">Action</th> -->
        </tr>


            @foreach($products as $item)
  
                <tr>
                    <td> <img width="150px" src="{{asset('storage/'.$item['image'])}}" onerror="this.onerror=null;
                    this.src='{{env('APP_URL')}}storage/no-image.png';" /></td>

          <td><img class="trending-image" src="{{ asset('storage/'.$item['image']) }}" width="150px"></td>
                    <td><a href="/clothes/details/{{$item['id']}}">
                        <h3>{{$item['title']}}</h3>
                    </a>
                    </td>

                    <td>{{$item['price']}}</td>

                    <td>
                        <form action="/delete/clothes/{{$item['id']}}" method="POST">
                            <button class="btn btn-info open-modal" value="{{$item['id']}}">Edit
                            </button>
                           
                            <!-- <a class="btn btn-primary" href="/update/clothes/{{$item['id']}}">Edit</a> -->
                        {{method_field('DELETE')}}
                        {!! csrf_field() !!}
                             <button class="btn btn-danger delete-link" value="{{$item['id']}}">Delete
                            </button>
                            <!-- <button type="submit" class="btn btn-danger" value="delete">Delete</button> -->
                        </form>
                    </td>
                </tr>
            @endforeach


    </table>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

     <div class="modal fade" id="formModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Product</h4>
                        </div>
                        <div class="modal-body">
                            <span id="form_result"></span>
                            <form method="post" enctype="multipart/form-data" id="sample_form" class="form-horizontal">
                                @csrf

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Price 
                                        <h6>IDR (Indonesian rupiah)</h6>
                                    </label>
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
                                        <span id="store_image"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <!-- <label class="col-sm-2 control-label">ID</label> -->
                                    <div class="col-sm-10">
                                         <input type="hidden" class="form-control" name="id" id="id">
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-primary" id="btn-save" value="add">Save product</button> -->
                            <input type="hidden" name="action" id="action" />
                            <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />

                            <!-- <input type="submit" name="save" id="save" class="btn btn-primary" value="Save product"> -->
                            <!-- <input type="hidden" id="link_id" name="link_id" value="0"> -->
                        </div>
                    </div>
                </div>
            </div>
        

</section>
</body>
</html>    

   
<script>
        $(document).ready(function(){

         $('#user_table').DataTable({
  processing: true,
  serverSide: true,
  ajax:{
   url: "{{ route('post') }}",
  },
  columns:[
   {
    data: 'image',
    name: 'image',
    render: function(data, type, full, meta){
     return "<img src={{ URL::to('/') }}/images/" + data + " width='70' class='img-thumbnail' />";
    },
    orderable: false
   },
   {
    data: 'first_name',
    name: 'first_name'
   },
   {
    data: 'last_name',
    name: 'last_name'
   },
   {
    data: 'action',
    name: 'action',
    orderable: false
   }
  ]
 });


        // execute function when click add new product
        $('#btn-create').click(function(){
            $('.modal-title').text("Add new product");
            $('#save').val("Add");
            $('#action').val("Add");
            $('#formModal').modal('show');
        }); 

        $('#create_record').click(function(){
  $('.modal-title').text("Add New Record");
     $('#action_button').val("Add");
     $('#action').val("Add");
     $('#formModal').modal('show');
 });

         $('#sample_form').on('submit', function(event){
  event.preventDefault();
  if($('#action').val() == 'Add')
  {
   $.ajax({
    url:"{{ route('post') }}",
    method:"POST",
    data: new FormData(this),
    contentType: false,
    cache:false,
    processData: false,
    dataType:"json",
    success: function(data)
    {
     var html = '';
     if(data.errors)
     {
      html = '<div class="alert alert-danger">';
      for(var count = 0; count < data.errors.length; count++)
      {
       html += '<p>' + data.errors[count] + '</p>';
      }
      html += '</div>';
     }
     if(data.success)
     {
      html = '<div class="alert alert-success">' + data.success + '</div>';
      $('#sample_form')[0].reset();
      $('#product_table').DataTable().ajax.reload();
     }
     $('#form_result').html(html);
    }
   })
  }


        });

    });
    </script>

