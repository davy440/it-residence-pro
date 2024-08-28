// JS for Property Filter
(function() {
    const filterDiv = document.querySelector('.itre-property-filter');
    if (!filterDiv) {
        return;
    }
	
    const form = filterDiv.querySelector('form');
    const propertyContainer = document.querySelector('.itre-property-listing');
    const nghbrs = filterDiv.nextElementSibling;
	
    const { ajaxurl, action_filter, nonce_filter, nghbr_action, nghbr_nonce } = filter;

    const filterProperties = async (body) => {
        const response = await fetch(ajaxurl, {
            method: 'POST',
            credrentials: 'same-origin',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body
        });
        const results = await response.text();
        return results;
    };

    const updateProperties = async (resuestBody) => {
        propertyContainer.innerHTML = "";
        propertyContainer.insertAdjacentHTML('beforebegin', '<div class="spinner"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22"><path d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z" transform="translate(-1 -1)" fill="#2e6d87" opacity="0.25" style="isolation:isolate"/><path d="M12,4a8,8,0,0,1,7.89,6.7A1.52,1.52,0,0,0,21.38,12h0a1.5,1.5,0,0,0,1.5-1.5,2.11,2.11,0,0,0,0-.25,11,11,0,0,0-21.72,0A1.5,1.5,0,0,0,2.37,12l.25,0h0a1.52,1.52,0,0,0,1.49-1.3A8,8,0,0,1,12,4Z" transform="translate(-1 -1)" fill="#2e6d87"/></svg></div>');
        
    	const filteredProperties = await filterProperties(resuestBody);
		propertyContainer.innerHTML = filteredProperties;
        propertyContainer.previousElementSibling.remove();
    }

    const nghbrRequest = async (location) => {
        let body = `action=${nghbr_action}&nonce=${nghbr_nonce}&location=${location}`;
        return await filterProperties(body);
    }

    const addNghbrs = async (e) => {
        [...nghbrs.children].forEach(nghbr => nghbr.classList.remove('selected'));
        e.target.classList.add('selected');
        const nghbrSlug = e.target.dataset.location;
        const body = `action=${action_filter}&nonce=${nonce_filter}&location=${nghbrSlug}`;
        updateProperties(body);
    }

    const clearNghbrs = () => {
        const oldNghbrs = nghbrs.querySelectorAll('span');
        if (oldNghbrs.length === 0) {
            return;
        }
        [...oldNghbrs].forEach(nghbr => {
            nghbr.removeEventListener('click', addNghbrs);
            nghbr.remove();
        })
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        let requestBody = '';
        const data = new FormData(form);
        for (const pair of data.entries()) {
            if (pair[1] !== "" && pair[1] !== "0") {
                requestBody += `&${pair[0]}=${pair[1]}`;
            }
        }

        if (requestBody === "") {
            return;
        }

        clearNghbrs();
        // In case locations are filtered, Update Neighbourhoods
        if (data.get('location') !== '0') {
            const nghbrList = await nghbrRequest(data.get('location'));
            if (nghbrList !== "") {
                nghbrs.innerHTML = nghbrList;
                [...nghbrs.children].forEach(child => {
                    child.addEventListener('click', addNghbrs);
                });
            }
        }

        const body = `action=${action_filter}&nonce=${nonce_filter}${requestBody}`;
        updateProperties(body);
    });
})();