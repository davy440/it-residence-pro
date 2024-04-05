(function() {
    const tabSections = document.querySelectorAll('.itre-featured-tabs');

    if (tabSections.length === 0) {
        return;
    }

    tabSections.forEach(section => {
        const buttons = section.querySelectorAll('.itre-featured-tabs__tab-titles span');
        const contents = section.querySelectorAll('.itre-featured-tabs__posts');
        if (buttons.length === 0) {
            return;
        }

        const toggleBtns = element => {
            buttons.forEach(item => item.classList.remove('is-active'));
            element.classList.add('is-active');
        }

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                toggleBtns(this);
                contents.forEach(content => {
                    if (content.dataset.tab === this.dataset.content) {
                        setTimeout(() => content.style.display = 'flex', 300);
                        setTimeout(() => content.style.opacity = '1', 310);
                        
                    } else {
                        setTimeout(() => content.style.display = 'none', 300);
                        content.style.opacity = '0';
                    }
                });
            })
        });
    });
})();