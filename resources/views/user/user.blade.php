<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>User Panel</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
 
 <style>
   .container{
    padding: 0.5%;
   } 
</style>
</head>
<body>
 
<div class="container">
    <h2 style="margin-top: 12px;" class="alert alert-success">User Address </h2><br>
    <div class="row">
        <div class="col-12">
          <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-post">Add details</a> 
          
       </div> 
    </div>
</div>
<div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="postCrudModal"></h4>
    </div>
    <div class="modal-body">
        <form id="postForm" name="postForm" class="form-horizontal">
           <input type="hidden" name="post_id" id="post_id">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">UserName</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="userName" name="userName" value="" required="">
                </div>
            </div>
 
            <div class="form-group">
                <label class="col-sm-2 control-label">UserEmail</label>
                <div class="col-sm-12">
                    <input class="form-control" id="userEmail" name="userEmail" value="" required="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">UserPhone</label>
                <div class="col-sm-12">
                    <input class="form-control" id="userPhone" name="userPhone" value="" required="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">PresentDivision</label>
                <div class="col-sm-12">
                    <input class="form-control" id="presentDivision" name="presentDivision" value="" required="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">PresentDistrict</label>
                <div class="col-sm-12">
                    <input class="form-control" id="presentDistrict" name="presentDistrict" value="" required="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">PresentThana</label>
                <div class="col-sm-12">
                    <input class="form-control" id="presentThana" name="presentThana" value="" required="">
                </div>
            </div>
                        <div class="form-group">
                <label class="col-sm-2 control-label">PermanentDivision</label>
                <div class="col-sm-12">
                    <input class="form-control" id="permanentDivision" name="permanentDivision" value="" required="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">PermanentDistrict</label>
                <div class="col-sm-12">
                    <input class="form-control" id="permanentDistrict" name="permanentDistrict" value="" required="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">PermanentThana</label>
                <div class="col-sm-12">
                    <input class="form-control" id="permanentThana" name="permanentThana" value="" required="">
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
             <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save
             </button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        
    </div>
</div>
</div>
</div>
</body>
</html>
<script>

  $(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#create-new-post').click(function () {
        $('#btn-save').val("create-post");
        $('#postForm').trigger("reset");
        $('#postCrudModal').html("Add New post");
        $('#ajax-crud-modal').modal('show');
    });
 
    $('body').on('click', '#edit-post', function () {
      var post_id = $(this).data('id');
    
      $.get('user/'+post_id+'/edit', function (data) {
         $('#postCrudModal').html("Edit post");
          $('#btn-save').val("edit-post");
          $('#ajax-crud-modal').modal('show');
          $('#post_id').val(data.id);
            $('#userName').val(data.userName);
            $('#userEmail').val(data.userEmail);
            $('#userPhone').val(data.userPhone);
            $('#presentDivision').val(data.presentDivision);
            $('#presentDistrict').val(data.presentDistrict);
            $('#presentThana').val(data.presentThana);
            $('#permanentDivision').val(data.permanentDivision);
            $('#permanentDistrict').val(data.permanentDistrict);
            $('#permanentThana').val(data.permanentThana);
      })
   });
    $('body').on('click', '.delete-post', function () {
        var post_id = $(this).data("id");
        confirm("Are You sure want to delete !");
 
        $.ajax({
            type: "DELETE",
            url: "{{ url('user')}}"+'/'+post_id,
            success: function (data) {
                $("#post_id_" + post_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });   
  });
 
 if ($("#postForm").length > 0) {
      $("#postForm").validate({
 
     submitHandler: function(form) {
      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');
      
      $.ajax({
          data: $('#postForm').serialize(),
          url: "{{ route('user.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              var post = '<tr id="post_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.userName + '</td><td>' + data.userEmail + '</td><td>' 
              + data.userPhone + '</td><td>' + data.presentDivision + '</td><td>' + data.presentDistrict + '</td><td>' + data.presentThana + '</td><td>' + data.permanentDivision + '</td><td>' + data.permanentDistrict + '</td><td>' + data.permanentThana + '</td>';
              post += '<td><a href="javascript:void(0)" id="edit-post" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
              post += '<td><a href="javascript:void(0)" id="delete-post" data-id="' + data.id + '" class="btn btn-danger delete-post">Delete</a></td></tr>';
               
              
              if (actionType == "create-post") {
                console.log(data.id);
                  $('#posts-crud').prepend(post);
              } else {
                  $("#post_id_" + data.id).replaceWith(post);
              }
 
              $('#postForm').trigger("reset");
              $('#ajax-crud-modal').modal('hide');
              $('#btn-save').html('Save Changes');
              
          },
          error: function (data) {
              console.log('Error:', data);
              $('#btn-save').html('Save Changes');
          }
      });
    }
  })
}
   
  
</script>