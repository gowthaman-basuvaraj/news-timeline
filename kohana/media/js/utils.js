/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
  $(".comment-reply-link").click(function(){
    action_url = base_url+"index.php/news/comment/"+$(this).attr("news")+"/"+$(this).attr("comment");
    $(".comment-reply-form-container.comment").find("form").attr("action", action_url)
    $(this).after($(".comment-reply-form-container.comment").toggle());
  });
  $(".add-followup-link").click(function(){
   $(".comment-reply-form-container.story").toggle()
  });
  
  $("a.nav-a").click(function(e){
    elem = $(e.target);
    if(elem.next(".quick-form").length==0){
      return true;
    }else {
      $(".quick-form").hide();
      
      if(!elem.hasClass("clicked")){
        $(".clicked").removeClass("clicked");
        elem.addClass("clicked");
        elem.next(".quick-form").show();
      }else {
        elem.removeClass("clicked");
        elem.next(".quick-form").hide();
      }
      e.preventDefault();
      return false;
    }
    
  })
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
  
  
  $(".more-link-toggle").click(function(){
    if($(this).hasClass("expand")) {
      $("#partial-news").css("display","inline").css("margin-left","-5px");
      $(this).html("Show Less");
    }else {
      $("#partial-news").hide();
      $(this).html("Show All");
    }
    $(this).toggleClass("expand");
      $(this).toggleClass("collapse");
    
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
