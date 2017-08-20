$(document).ready(function() {
    var wrapper = $("#user_list");
    var shownUsers = [];
    showUsers = function(users){
        for(i=0; i < users.length; i++){
            user = users[i];
            
            var ed_field = '';
            if(user.education){
                for(e = 0; e < user.education.length; e++){
                    edata = user.education[e];
                    ed_field += '<p class="list-group-item-text">'+edata.degree+' , '+edata.institute+' , '+edata.year+'</p>';
                }
                
                ed_field = '<div class="list-group col-md-10> \n\
                                <h4 class="list-group-item-heading">Education</h4>\n\
                                '+ed_field+
                            '</div>';
            }
            
            if(user.address){
                addr_field = '<p class="list-group-item-text">' +user.address.line1 + (user.address.line2? '':', ' + user.address.line2) + '</p>';
                addr_field += '<p class="list-group-item-text">' +user.address.city + ', ' + user.address.region+ '</p>';
                addr_field += '<p class="list-group-item-text">' +user.address.country + ' - ' + user.address.zip+ '</p>';
                
                addr_field = '<div class="list-group col-md-10> \n\
                                <h4 class="list-group-item-heading">Address</h4>\n\
                                '+addr_field+
                            '<div>';
            }
            
            $(wrapper).append(
                 '<div class="list-group col-md-12">\n\
                    <div class="list-group-item user-info listitem" style="overflow: auto;" data-toggle="collapse" data-target="#details_'+shownUsers.length+'"> \n\
                        <h4 class="list-group-item-heading">'+user.name+'</h4>\n\
                        <div style="display:inline-flex;" class="list-group-item-text">\n\
                            <i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp;&nbsp;<p>'+user.nationality+'</p>\n\
\n\                     </div><br>\n\
                        <div class="collapse col-md-10 user-details" id="details_'+shownUsers.length+'">\n\
                            <div style="display:inline-flex;" class="list-group-item-text">\n\
                                <i class="fa fa-envelope-o" aria-hidden="true"></i> &nbsp;&nbsp; <p>'+user.email+(user.pref_comm == 'email' ? '(Primary)':'')+'</p>\n\
                            </div><br>\n\
                            <div style="display:inline-flex;" class="list-group-item-text">\n\
                                <i class="fa fa-phone" aria-hidden="true"></i> &nbsp; &nbsp; <p>'+user.phone+(user.pref_comm == 'phone' ? '(Primary)':'')+'</p>\n\
                            </div><br>\n\
                            <div style="display:inline-flex;" class="list-group-item-text">\n\
                                <i class="fa fa-venus-mars" aria-hidden="true"></i> &nbsp; &nbsp; <p>'+user.gender+'</p>\n\
                            </div><br>\n\
                            <div style="display:inline-flex;" class="list-group-item-text">\n\
                                <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp; &nbsp; <p class="list-group-item-text">'+user.dob+'</p>\n\
                            </div><br><br>\n\
                            '+ed_field+'\n\
                            '+addr_field+'\n\
                        </div>\n\
                    </div>\n\
                  </div>'); 
            shownUsers.push(user);
        }
                
        if(users.length == 0){
            $(view_more_button).hide();
        }
    };
    
    showUsers(first_users_list);
    var page = 1;
    loadMore = function(){
        $.get("users/"+page, function( data ) {
            users = JSON.parse(data);
            showUsers(users);
        });
        page++;
    };
    
    view_more_button = $('#view_more_button');
    $(view_more_button).click(function(e){
        loadMore();
    });
    $('body').on('click', 'div.listitem', function() {
        if ($(this).hasClass('active')){
            $(this).removeClass('active');
        }else{
            $(this).addClass('active');
        }
    });
    
    
});