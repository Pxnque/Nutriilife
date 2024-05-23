document.addEventListener('DOMContentLoaded', () => {
    const stories = document.querySelectorAll('.story');
    
    stories.forEach(story => {
        story.addEventListener('click', () => {
            const url = story.getAttribute('data-url');
            if (url) {
                window.location.href = url;
            }
        });
    });
});
