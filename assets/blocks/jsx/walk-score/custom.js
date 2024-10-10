const scoreColors = () => {
    const coreSections = document.querySelectorAll('.itre-walk-score');

    if (coreSections.length === 0) {
        return;
    }

    coreSections.forEach(section => {
        const scores = section.querySelectorAll('.itre-walk-score__score');

        if (scores.length === 0) {
            return;
        }

        scores.forEach(score => {
            const count = parseInt(score.textContent);
            
            if (count <= 25) {
                score.style.backgroundColor = '#E22525';
            }

            if (count > 25 && count <= 75) {
                score.style.backgroundColor = '#F69B07';
            }

            if (count > 75) {
                score.style.backgroundColor = '#45E40B';
            }
        })
    });
}
scoreColors();