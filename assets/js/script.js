$(document).ready(function() {
    // Load posts when the page loads
    loadPosts();

    // Handle form submission
    $('#postForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        var postId = $('#postId').val();
        var title = $('#title').val();
        var content = $('#content').val();

        $.ajax({
            url: 'src/post-handler.php',
            type: 'POST',
            dataType: 'json',
            data: {
                id: postId,
                title: title,
                content: content
            },
            success: function(response) {
                if (response.success) {
                    $('#postModal').modal('hide');
                    loadPosts(); // Reload posts after saving
                } else {
                    alert('Error: ' + response.message);
                }
            }
        });
    });

    // Load posts function
    function loadPosts() {
        $.ajax({
            url: 'src/get-posts.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var postsHtml = '';
                $.each(data.posts, function(index, post) {
                    postsHtml += '<div class="post"><h2>' + post.title + '</h2><p>' + post.content + '</p></div>';
                });
                $('#posts').html(postsHtml);
            }
        });
    }
});
