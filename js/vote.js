document.addEventListener('DOMContentLoaded', () => {
    const voteButtons = document.querySelectorAll('.vote-section button');

    voteButtons.forEach(button => {
        button.addEventListener('click', async function (event) {
            event.stopPropagation(); // Prevent the click from propagating to the <a> tag
            const postId = this.getAttribute('data-post-id');
            const voteType = this.getAttribute('data-vote-type');
            
            try {
                const response = await fetch('vote.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ postId, voteType })
                });


                const data = await response.json();
                if (data.redirect) {
                    // Redirect to login page if user is not logged in
                    window.location.href = data.redirect;
                }
                else if (data.success) {
                    window.location.reload(); // Reload to update the vote counts
                } else {
                    alert(data.message);
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });
    });
});