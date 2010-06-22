/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
  $(".comment-reply-link").click(function(){
    action_url = base_url+"index.php/news/comment/"+$(this).attr("news")+"/"+$(this).attr("comment");
    $(".comment-reply-form-container").find("form").attr("action", action_url)
    $(this).after($(".comment-reply-form-container").toggle());
  });
  $(".comment-toggle").click(function(){
    $(this).parent().parent().toggleClass("expanded");
    $(this).parent().parent().toggleClass("collapsed");
    if($(this).hasClass("open")){
      ccount = parseInt($(this).attr("child-count"));
     
      $.each($(this).parent().parent().find(".comment-children").find(".comment-toggle"), function(i,v){
        ccount += parseInt($(v).attr("child-count"));
      });
      $(this).html("[+]" + ccount +" comments");
      $(this).addClass("close");
      $(this).removeClass("open");
    }else {
      $(this).html("[-]");
      $(this).addClass("open");
      $(this).removeClass("close");
    }
  });
});


