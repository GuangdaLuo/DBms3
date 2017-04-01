$(document).ready(function() {
    console.log("list client");
    list_client();
});

var list_client = function() {
    $.ajax({
        url: '../cgi-bin/list_client.php',

        data: {
            type: "all"
        },

        type: "POST",

        dataType: "json",

        success: function(response) {
            console.log("list_client.php executed");
            if (response != null) {
                var activities = response.activity;
                var $all_activities = $('#all_activities');
                for (var i = 0; i < activities.length; i++) {
                    var activity = activities[i];
                    /* add a new table row in this table */
                    var tr = "<tr class=\"table_entry\">";
                    tr += "<td>" + add_link(activity.act_id, activity.title) + "</td>";
                    tr += "<td>" + activity.username + "</td>";
                    tr += "<td>" + activity.reply_times + "</td>";
                    tr += "<td>" + activity.create_time + "</td>";
                    tr += "</tr>";
                    $all_activities.append(tr);
                }
            }

        },

        error: function(response) {
            console.log("ERROR: fetch all activities failed");
            // error
            console.log(response);
        }
    }); 
};

var add_link = function(id, title) {
    return "<a href=\"../cgi-bin/" + "view_activity.py?id=" + id + "\">" + title + "</a>";
}
