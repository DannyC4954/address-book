$(document).ready(function(){

  $( ".menu" ).click(function() {
    $( ".side-bar" )
      // .animate({ fontSize: "24px" }, 500 )
      .css('z-index', 1)
      .css('overflow-x', "hidden")
      .css('top', 0)
      .css('left', 0)
      .css('position', 'fixed')
      .css('display', 'block')
    $(".options").delay(1500).fadeIn();
  });

  $( ".close-icon" ).click(function() {
    $( ".side-bar" ).delay(200).fadeOut();
      // .animate({ width: "0%" }, 500 )
  });

  // AJAX Add 
  $('#ajax-form').on('submit', function(){

    var that = $(this),
    url = that.attr('action'),
    type = that.attr('method'),
    data = {};

    that.find('[name]').each(function(index, value){
      var that = $(this),
      name = that.attr('name'),
      value = that.val();

      data[name] = value;
    });

    if( data["first_name"].length == 0 ){
      $('.error-modal').show();
    } 
    if( data["last_name"].length == 0 ){
      $('.error-modal').show();
    }
    if( data["phone"].length < 11 ){
      $('.error-modal').show();
    }
    if( data["email"].length == 0 ){
      $('.error-modal').show();
    } else {
      $.ajax({
        url: url,
        type: type,
        data: data,
        success: function(response) {
          $( "tbody" ).append( "<tr><td>"+ data["first_name"] +" "+ data["last_name"] +"</td><td>"+ data["phone"] +"</td><td>"+ data["email"] +"</td><td><a class=\"action-btn\" href=\"./add?email="+ data["email"] +"\">Edit</a><label for=\"delete-"+ data["email"] +"\" class=\"action-btn red-bck\">Delete</label><form class=\"ajax-delete\" action=\"/address-book/home/ajaxdelete\" method=\"POST\"><input type=\"hidden\" name=\"delete-ID\" value=\""+ data["email"] +"\" /><input type=\"submit\" id=\"delete-"+ data["email"] +"\" class=\"hidden-ip\" name=\"delete-record\" /></form></td></tr>" );
          $('#ajax-form')[0].reset();
        }
      });
    }

    return false;
  });

  // Close error modal
  $('.close-btn').on('click', function(){
    $('.error-modal').hide();
  });

  // AJAX Delete 
  $('.ajax-delete').on('submit', function(){

    $(this).parent().parent().remove();

    var that = $(this),
    url = that.attr('action'),
    type = that.attr('method'),
    data = {};

    that.find('[name]').each(function(index, value){
      var that = $(this),
      name = that.attr('name'),
      value = that.val();

      data[name] = value;
    });

    $.ajax({
      url: url,
      type: type,
      data: data,
      success: function(response) {
        
      }
    });

    return false;
  });

  });
