jQuery(document).ready(function($) {

  const portfolioList = $('#portfolio_list');

  toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }

  portfolioList.sortable({
    opacity: 0.8,
    update: function(event, ui) {

      opts = {
        url: ajaxurl,
        type: 'POST',
        async: true,
        cache: false,
        // dataType: 'json',
        data:{
          action: 'portfolio_sort',
          order: portfolioList.sortable('toArray')
        },
        success: function(response) {
          // $('.ajax-message').html('<span style="color:green">Saved</span>');
          toastr.success('New Order Saved');
          // setTimeout(function(){ $('.ajax-message').html(''); }, 4000);
          return;
        },
        error: function(xhr,textStatus,e) {
          // $('.ajax-message').html('<span style="color:red">Saving Error, please try again</span>');
          toastr.error('Saving Error, please try again');
          // setTimeout(function(){ $('.ajax-message').html(''); }, 4000);
          // alert('There was an error saving the update.');
          // console.log(xhr + '|' + textStatus + '|' + portfolioList.sortable('toArray'));
          return;
        }
      };
      $.ajax(opts);
    }
  });
});
