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
  $(".comment-delete-link").click(function(e){
    action_url = base_url+"index.php/news/comment_delete/"+$(this).attr("news")+"/"+$(this).attr("comment");
    var conf = confirm("You want to delete this comment?");
    if(conf){
      $.ajax({
        url: action_url,
        success : function(data){
          location.reload();
          
        }
      });
    }
  });
  $(".comment-toggle").click(function(){
    cid = $(this).attr("name");
    $("#comment-"+cid).toggleClass("expanded");
    $("#comment-"+cid).toggleClass("collapsed");
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
    $(this).next(".comment-item-content").toggle();
  });
});

function vote_comment(a, vote, prev_vote){
  if(prev_vote==0) {
    if(vote==1) {
      type="voteup";
    }else {
      type="votedown";
    }
  }else {
    if(vote==1) {
      type="votechangeup";
    }else {
      type="votechangedown";
    }
  }
  
  cid = $(a).attr("comment");
  action_url = base_url+"index.php/vote/"+type+"/"+cid;
  $.ajax({
    url: action_url,
    success : function(data){
      location.reload();
          
    }
  });
  return false;
   
}
