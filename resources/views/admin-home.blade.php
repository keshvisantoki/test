<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>
 <body>
   
  <div class="container">    

     <br />
     <h3 align="center">User Detail</h3>
     <br />
     <div align="right">
      <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
     </div>
     <br />
   <div class="table-responsive">
    <table id="user_table" class="table table-bordered table-striped">
     <thead>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Password</th>
        <th>Confirm Password</th>
        <th>Hobbies</th>
        <th>City</th>
        <th>Gender</th>
        <th>Action</th>
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
         <form method="post" id="sample_form" class="form-horizontal">
          @csrf

          <div class="form-group">
            <label class="control-label col-md-4" >First Name : </label>
            <div class="col-md-8">
             <input type="text" name="fname" id="fname" class="form-control" />
            </div>
           </div>

           <div class="form-group">
            <label class="control-label col-md-4">Last Name : </label>
            <div class="col-md-8">
             <input type="text" name="lname" id="lname" class="form-control" />
            </div>
           </div>

           <div class="form-group">
                <label for="txtLastName">Email:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="txtLastName">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>
            <div class="form-group">
                <label for="txtLastName">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="txtLastName">Confirm Password:</label>
                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword">
            </div>
            <div class="form-group">
                <label for="txtLastName">Hobbies:</label>
                <select name="hobbies" id="hobbies">
                  <option value="Reading">Reading</option>
                  <option value="Travelling">Travelling</option>
                  <option value="Singing">Singing</option>
                  <option value="Dance">Dance</option>
                </select>
            </div>
            <div class="form-group">
                <label for="txtLastName">City:</label>
                <select name="city" id="city">
                  <option value="Rajkot">Rajkot</option>
                  <option value="Ahmedabad">Ahmedabad</option>
                  <option value="Surat">Surat</option>
                  <option value="Baroda">Baroda</option>
                </select>
            </div>
            <div class="form-group">
                <label for="male">Male</label>
                <input type="radio" id="male" name="gender" value="male">
                <label for="female">Female</label> 
                <input type="radio" id="female" name="gender" value="female">
            </div>
                <br />
                <div class="form-group" align="center">
                 <input type="hidden" name="action" id="action" value="Add" />
                 <input type="hidden" name="hidden_id" id="hidden_id" />
                 <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
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
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

 </body>
</html>
<script>
$(document).ready(function(){

 $('#user_table').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
   url: "{{ route('user.index') }}",
  },
  columns: [
   {
    data: 'fname',
    name: 'fname'
   },
   {
    data: 'lname',
    name: 'lname'
   },
   {
    data: 'email',
    name: 'email'
   },
   {
    data: 'phone',
    name: 'phone'
   },
   {
    data: 'password',
    name: 'password'
   },
   {
    data: 'confirmpassword',
    name: 'confirmpassword'
   },
   {
    data: 'hobbies',
    name: 'hobbies'
   },
   {
    data: 'city',
    name: 'city'
   },
   {
    data: 'gender',
    name: 'gender'
   },
   {
    data: 'action',
    name: 'action',
    orderable: false
   }
  ]
 });

 // Add Record

 $('#create_record').click(function(){
  $('.modal-title').text('Add New Record');
  $('#action_button').val('Add');
  $('#action').val('Add');
  $('#form_result').html('');

  $('#formModal').modal('show');
 });

 $('#sample_form').on('submit', function(event){
  event.preventDefault();
  var action_url = '';

  if($('#action').val() == 'Add')
  {
   action_url = "{{ route('user.store') }}";
  }

  if($('#action').val() == 'Edit')
  {
   action_url = "{{ route('user.update') }}";
  }

  $.ajax({
   url: action_url,
   method:"POST",
   data:$(this).serialize(),
   dataType:"json",
   success:function(data)
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
     $('#user_table').DataTable().ajax.reload();
    }
    $('#form_result').html(html);
   }
  });
 });

 $(document).on('click', '.edit', function(){
  var id = $(this).attr('id');
  $('#form_result').html('');
  $.ajax({
   url :"/user/"+id+"/edit",
   dataType:"json",
   success:function(data)
   {
    $('#fname').val(data.result.fname);
    $('#lname').val(data.result.lname);
    $('#email').val(data.result.email);
    $('#phone').val(data.result.phone);
    $('#password').val(data.result.password);
    $('#confirmpassword').val(data.result.confirmpassword);
    $('#hobbies').val(data.result.hobbies);
    $('#city').val(data.result.city);
    $('#gender').val(data.result.gender);
    $('#hidden_id').val(id);
    $('.modal-title').text('Edit Record');
    $('#action_button').val('Edit');
    $('#action').val('Edit');
    $('#formModal').modal('show');
   }
  })
 });

 var user_id;

 $('body').on('click', '.delete', function () {
 
       user_id = $(this).attr('id');
        if(confirm("Are You sure want to delete !"))
        {
          $.ajax({
              type: "get",
              url: "{{ url('delete') }}"+'/'+user_id,
              success: function (data) {
              var oTable = $('#user_table').dataTable(); 
              oTable.fnDraw(false);
              },
              error: function (data) {
                  console.log('Error:', data);
              }
          });
       }
    });   
});
</script>
