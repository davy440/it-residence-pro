const section = document.querySelector('.itre-properties');

const initSubmit = () => {

    if (!section) {
        return;
    }

    const form = section.querySelector('form');
    const propsPerPage = form.querySelector('#perPage');
    const sort = form.querySelector('#sortBy');
    propsPerPage.addEventListener('change', () => form.submit());
    sort.addEventListener('change', () => form.submit());
}
initSubmit();