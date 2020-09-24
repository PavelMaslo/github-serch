require('./bootstrap');


markFavorit();

$('.save').click(function () {
    save($(this).parent());
});

$('.repositories.delete').click(function () {
    deleteFormFavorit($(this).parent());
    location.reload();
});

$('.search.delete').click(function () {
    deleteFormFavorit($(this).parent());
});


function deleteFormFavorit($parent) {
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "DELETE",
        url: "/repositories",
        data: {url: $parent.find('a.resourse').attr('href')},
        success: function (data) {
            $parent.find('.save').show();
            $parent.find('.delete').hide();
        }
    });
}

function markFavorit() {
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "post",
        url: "/repositories",
        success: function (data) {
            $.each(data, function (key, repository) {
                let parent = $('a[href="' + repository.url + '"]').parent().parent();
                parent.find('.save').hide();
                parent.find('.delete').show();
            });
        }
    });
}

function save($parent) {
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "get",
        url: "/repositories/create",
        data: {
            url: $parent.find('a').attr('href'),
            name: $parent.find('a').text(),
            description: $parent.find('p').text(),
            ownerLogin: $parent.find('.owner-login').text(),
            stargazersCount: $parent.find('.stargazers_count').text(),
        },
        success: function (msg) {
            $parent.find('.save').hide();
            $parent.find('.delete').show();
        }
    });
}
