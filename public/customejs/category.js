  /* Project Name: Block Chain 
     Website: https://akestech.com 
     Author: Nandan Bind */

$(document).ready(function() {
    categoryTable();
});

$('#category_form').on('submit',function(e){
    e.preventDefault();
    $.ajax({
      url:siteUrl+'/save_category',
      type:'post',
      data:new FormData(this),
      processData:false,
      contentType:false,
      success:function(response){
            if(response.status == 1){
                  ClearForm();
                  $("#addcode").html('<img src="'+siteUrl+'/images/placeholder.png">');
                  toastr["success"](response.msg);
                  $('#category_datatable').DataTable().destroy();
                  categoryTable();
            }else if(response.status == 9){
                  var dd = response.error ;
                  for(var i=0; i<dd.length;i++){
                  toastr["error"](dd[i]);
                  }
            }else if(response.status == 2){
                toastr["error"](response.msg);
          }
      }
    });
  });

  function ClearForm(){
      $("#category_form").trigger('reset');
      $("#id").val('');
      $('#image').attr('required',true);
      $('#button').text('Add Category');
  }
    

  /* For Process orders functions  */

  function categoryTable(){   
      $.ajaxSetup({
                  headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
              });
    $('#category_datatable').DataTable({
            'searching': true,
            'ordering': true,
            'processing': true,
            'paging': true,
            'order': [[0, "desc"]],
            "aoColumnDefs": [
              { "bSortable": false, "aTargets": [ 1,2,3,4 ] }
            ],
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
              'url':siteUrl+'/show_category'
            },
            'columns': [
                         
              { data: 'id' },
              { data: 'image' },
              { data: 'title' },
              { data: 'status' },
              { data: 'action' },
          ]
      });
     
  }

$(document).on('click',"#filter_button",function(){
    $('#process_orders_datatable').DataTable().destroy();
    let filter_range = $("#custom_daterange").val();
    let order_id = $("#order_id").val();
    let pay_type = $("#pay_type").val();
    let status = $("#status").val();
    if(filter_range !='' || order_id !='' || pay_type !='' || status !='')
    {
      $.ajaxSetup({
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
                });
      table = $('#process_orders_datatable').DataTable({
            'searching': true,
            'ordering': true,
            'processing': true,
            'paging': true,
            'order': [[2, "desc"]],
            "aoColumnDefs": [
              { "bSortable": false, "aTargets": [ 1,3,4,5,6,7,8,9,10 ] }
            ],
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
              'url':siteUrl+'/show_process_orders',
              'data' : { 'filter_range' : filter_range,
                          'order_id' : order_id,                     
                          'pay_type' : pay_type,                     
                          'status' : status,                     
                       }
            },          
            'columns': [
              { 
                  "className":      'details-control',
                  "orderable":      false,
                  "data":           null,
                  "defaultContent": ''
              },             
              { data: 'check' },
              { data: 'order_date' },
              { data: 'channel' },
              { data: 'order_id' },
              { data: 'status' },
              { data: 'payment' },
              { data: 'customer_detail' },
              { data: 'pickup_address' },
              { data: 'd&w' },
              { data: 'action' },
          ],                 
        });
         
      }
      else
      {
         toastr.options = { positionClass: "toast-top-right", closeButton: true, progressBar: true, showMethod: "slideDown", timeOut: 5000 };
                  toastr.error("error", "Please select any filter first!");
      }
  });

function delete_category(id = ''){
    if (confirm("Are you sure!")) {
        $.ajax({
            url:siteUrl+'/delete_category',
            type:'post',
            data:{id:id},
            success:function(response)
            {
               if(response['status']==1){
                    toastr["success"](response.msg);
                    $('#category_datatable').DataTable().destroy();
                    categoryTable();
                }else if(response['status']==2){
                    toastr["error"](response.msg);
                    $('#category_datatable').DataTable().destroy();
                    categoryTable();
                }
            }
        });
     }
} 
 
function category_status(id = '',status = ''){
    
    $.ajax({
        url:siteUrl+'/category_status',
        data:{'id':id,'status':status},
        type:'post',
        dataType:'json',
        success:function(response)
        {
            if(response['status']==1){
                toastr["success"](response.msg);
                $('#category_datatable').DataTable().destroy();
                categoryTable();
            }else if(response['status']==2){
                toastr["error"](response.msg);
                $('#category_datatable').DataTable().destroy();
                categoryTable();
            }
        }
    });
}

function edit_category(id=''){  

    $.ajax({
        url:siteUrl+'/edit_category',
        data:{'id':id},
        type:'post',
        dataType:'json',
        success:function(res)
        {
            $('#id').val(res.id);
            $('#title').val(res.title);
            $('#image').attr('required',false);
            $('#description').val(res.description); 
            $('#addcode').html('<img src="'+siteUrl+'/uploads/'+res.image+'" width="100%" height="250px">');  
            $('#button').text('Update Category');
        }
    });
}

function showSelectedImage(input='' , i='') {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              var data = '<img src="'+e.target.result+'" width="100%" height="250px" >';
              $("#addcode"+i).html(data);
          };
          reader.readAsDataURL(input.files[0]);
      }
  }