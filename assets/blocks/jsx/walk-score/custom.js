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

const fetchData = async () => {
    const { street, city, province, country, lat, lon } = property;

    const response = await fetch('https://api.walkscore.com/score?format=json&address=4673%20Quilly%20Lane%20Wilmington%20DE&lat=39.755541831768404&lon=-75.56700944548646&transit=1&bike=1&wsapikey=ab8dd6bd1447bc563f32a8ed09c16e6d', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });
    const data = await response.json();
    consolelog(data);
}
fetchData();