function searchUserResults(e) {
    let value = e.target.value
    if (value != "") {
        $.ajax({
            url: '../controllers/users.controller.php',
            method: 'POST',
            data: {
                'getUsersByName': 'getUsersByName',
                'userParamsValue': value
            },
            dataType: 'json',
            success: function (data) {
                $('#searchBody').html(
                    searchResultsBuilder(data)
                )
            }
        });
    }
    else{
        $('#searchBody').html("")
    }
}

function searchResultsBuilder(data) {
    var userId, userFirstName, userLastName
    var post = '<ul>'
    for (var i in data) {
        userId = data[i][0]
        userFirstName = data[i][1]
        userLastName = data[i][2]
        post += '<a href="profile.php?id='+userId+'"><li id="' + userId + '" >' + userFirstName + ' ' + userLastName + ' </li></a>'
    }
    post += '</ul>';

    return post;
}
