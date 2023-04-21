let counter = 0;
let counter_aside = 0;
let counter_delete = 0;

const aside_company = document.getElementById('aside');
const delete_btn = document.getElementById('aside-data-btn-sure');
const name_form = document.getElementById('name-form-form');
const inn_form = document.getElementById('inn-form-form');
const info_form = document.getElementById('info-form-form');
const boss_form = document.getElementById('boss-form-form');
const street_form = document.getElementById('street-form-form');
const number_form = document.getElementById('number-form-form');
const company_form = document.getElementById('company-form-form');

//Функция для возврата с поля регистрации
function back_to_index() {
    document.location.href="/index.php";
}

//Функция для сокрытия поля aside
function hide_aside() {
    aside_company.style.display = 'none';
    delete_btn.style.display = 'none';
    counter_aside = 0;
    counter_delete = 0;
}

//Функция для сокрытия кнопки удаления компании внутри aside
function delete_aside() {
    if (counter_delete === 0) {
        delete_btn.style.display = 'block';
        counter_delete = 1;
    } else {
        delete_btn.style.display = 'none';
        counter_delete = 0;
    }
}

//Функция изменения стилей при создании новой компании
function new_company() {
    const company_popup = document.getElementById('create-company-popup');
    if (counter === 0) {
        company_popup.style.display = 'flex';
        const elements = document.querySelectorAll('.company-block');

        for (let elem of elements) {
            elem.style.background = 'linear-gradient(\n' + 'rgba(0, 0, 0, 0.1), \n' + 'rgba(0, 0, 0, 0.1)';
        }
        document.body.style.background = 'linear-gradient(\n' + 'rgba(0, 0, 0, 0.9), \n' + 'rgba(0, 0, 0, 0.9)';
        counter++;
    } else {
        company_popup.style.display = 'none';
        const elements = document.querySelectorAll('.company-block');

        for (let elem of elements) {
            elem.style.background = '#D9D9D9';
        }
        document.body.style.background = 'linear-gradient(\n' + 'rgba(0, 0, 0, 0), \n' + 'rgba(0, 0, 0, 0)';
        counter--;
    }
}

//Функция для открытия полей input для написания комментариев
function comment() {
    const first_comment = document.getElementById('aside-data-name-comment-p');
    const second_comment = document.getElementById('aside-data-inn-comment-p');
    const three_comment = document.getElementById('aside-data-info-comment-p');
    const four_comment = document.getElementById('aside-data-boss-comment-p');
    const five_comment = document.getElementById('aside-data-street-comment-p');
    const six_comment = document.getElementById('aside-data-number-comment-p');
    const seven_comment = document.getElementById('aside-data-comment-comment-p');

    first_comment.onclick = function () {
        if (name_form.style.display === 'none') {
            name_form.style.display = 'flex';
        } else {
            name_form.style.display = 'none';
        }
    }
    second_comment.onclick = function () {
        if (inn_form.style.display === 'none') {
            inn_form.style.display = 'flex';
        } else {
            inn_form.style.display = 'none';
        }
    }
    three_comment.onclick = function () {
        if (info_form.style.display === 'none') {
            info_form.style.display = 'flex';
        } else {
            info_form.style.display = 'none';
        }
    }
    four_comment.onclick = function () {
        if (boss_form.style.display === 'none') {
            boss_form.style.display = 'flex';
        } else {
            boss_form.style.display = 'none';
        }
    }
    five_comment.onclick = function () {
        if (street_form.style.display === 'none') {
            street_form.style.display = 'flex';
        } else {
            street_form.style.display = 'none';
        }
    }
    six_comment.onclick = function () {
        if (number_form.style.display === 'none') {
            number_form.style.display = 'flex';
        } else {
            number_form.style.display = 'none';
        }
    }
    seven_comment.onclick = function () {
        if (company_form.style.display === 'none') {
            company_form.style.display = 'flex';
        } else {
            company_form.style.display = 'none';
        }
    }
}

//Функция получения комментов конкретного элемента и заполнения ими блоков + ajax запросы с занесением комментариев в базу
function addNum(el) {

    let company = (el.textContent);
    let b = company.split("\n");
    const index = b.filter(n => n);

    let aside_data_name = document.getElementById('aside-data-name-p');
    aside_data_name.innerHTML = index[0];

    let aside_data_inn = document.getElementById('aside-data-inn-p');
    aside_data_inn.innerHTML = index[1];

    let aside_data_info = document.getElementById('aside-data-info-p');
    aside_data_info.innerHTML = index[2];

    let aside_data_boss = document.getElementById('aside-data-boss-p');
    aside_data_boss.innerHTML = index[3];

    let aside_data_street = document.getElementById('aside-data-street-p');
    aside_data_street.innerHTML = index[4];

    let aside_data_number = document.getElementById('aside-data-number-p');
    aside_data_number.innerHTML = index[5];

    const name_comment = document.getElementById('aside-data-name-comment');
    const inn_comment = document.getElementById('aside-data-inn-comment');
    const info_comment = document.getElementById('aside-data-info-comment');
    const boss_comment = document.getElementById('aside-data-boss-comment');
    const street_comment = document.getElementById('aside-data-street-comment');
    const number_comment = document.getElementById('aside-data-number-comment');
    const company_comment = document.getElementById('aside-data-company-comment');

    if (index.length > 1) {
        function get_comment() {
            let company_name = index[0];

            let xhr = new XMLHttpRequest();
            xhr.open('POST', '/script/ajax/get_comments.php');
            xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    try {
                        let string = xhr.responseText;
                        let json = JSON.parse(string);
                        name_comment.innerHTML = '';
                        inn_comment.innerHTML = '';
                        info_comment.innerHTML = '';
                        boss_comment.innerHTML = '';
                        street_comment.innerHTML = '';
                        number_comment.innerHTML = '';
                        company_comment.innerHTML = '';
                        let i = 0;
                        while (json.length !== 0) {
                            if (i === 0) {
                                if (json[3] === '') {
                                    i++;
                                } else {
                                    const newP = document.createElement('p');
                                    newP.textContent = json[0] + ' ' + json[1] + ' ' + json[3];
                                    name_comment.appendChild(newP);
                                    i++;
                                }
                            }
                            if (i === 1) {
                                if (json[4] === '') {
                                    i++;
                                } else {
                                    const newP = document.createElement('p');
                                    newP.textContent = json[0] + ' ' + json[1] + ' ' + json[4];
                                    inn_comment.appendChild(newP);
                                    i++;
                                }
                            }
                            if (i === 2) {
                                if (json[5] === '') {
                                    i++;
                                } else {
                                    const newP = document.createElement('p');
                                    newP.textContent = json[0] + ' ' + json[1] + ' ' + json[5];
                                    info_comment.appendChild(newP);
                                    i++;
                                }
                            }
                            if (i === 3) {
                                if (json[6] === '') {
                                    i++;
                                } else {
                                    const newP = document.createElement('p');
                                    newP.textContent = json[0] + ' ' + json[1] + ' ' + json[6];
                                    boss_comment.appendChild(newP);
                                    i++;
                                }
                            }
                            if (i === 4) {
                                if (json[7] === '') {
                                    i++;
                                } else {
                                    const newP = document.createElement('p');
                                    newP.textContent = json[0] + ' ' + json[1] + ' ' + json[7];
                                    street_comment.appendChild(newP);
                                    i++;
                                }
                            }
                            if (i === 5) {
                                if (json[8] === '') {
                                    i++;
                                } else {
                                    const newP = document.createElement('p');
                                    newP.textContent = json[0] + ' ' + json[1] + ' ' + json[8];
                                    number_comment.appendChild(newP);
                                    i++;
                                }
                            }
                            if (i === 6) {
                                if (json[9] === '') {
                                    i++;
                                } else {
                                    const newPx = document.createElement('p');
                                    newPx.textContent = json[0] + ' ' + json[1] + ' ' + json[9];
                                    company_comment.appendChild(newPx);
                                    i++;
                                }
                            }
                            if (i === 7) {
                                json.splice(0,10);
                                i = 0;
                            }
                        }
                    } catch (err) {
                        console.log(err);
                    }
                }
            }
            xhr.send('get_comment=' + company_name);
        }
        get_comment();
    }

    name_form.onsubmit = function (e) {
        e.preventDefault();
        let name_form_inp = document.getElementById('name-form-inp').value;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '/script/ajax/post_comments.php');

        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                get_comment();
            }
        }
        xhr.send('aside-data-name-inp=' + name_form_inp);
        document.getElementById('name-form-inp').value = "";
    }

    inn_form.onsubmit = function (e) {
        e.preventDefault();
        let inn_form_inp = document.getElementById('inn-form-inp').value;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '/script/ajax/post_comments.php');

        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                get_comment();
            }
        }
        xhr.send('aside-data-inn-inp=' + inn_form_inp);
        document.getElementById('inn-form-inp').value = "";
    }

    info_form.onsubmit = function (e) {
        e.preventDefault();
        let info_form_inp = document.getElementById('info-form-inp').value;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '/script/ajax/post_comments.php');

        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                get_comment();
            }
        }
        xhr.send('aside-data-info-inp=' + info_form_inp);
        document.getElementById('info-form-inp').value = "";
    }

    boss_form.onsubmit = function (e) {
        e.preventDefault();
        let boss_form_inp = document.getElementById('boss-form-inp').value;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '/script/ajax/post_comments.php');

        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                get_comment();
            }
        }
        xhr.send('aside-data-boss-inp=' + boss_form_inp);
        document.getElementById('boss-form-inp').value = "";
    }

    street_form.onsubmit = function (e) {
        e.preventDefault();
        let street_form_inp = document.getElementById('street-form-inp').value;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '/script/ajax/post_comments.php');

        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                get_comment();
            }
        }
        xhr.send('aside-data-street-inp=' + street_form_inp);
        document.getElementById('street-form-inp').value = "";
    }

    number_form.onsubmit = function (e) {
        e.preventDefault();
        let number_form_inp = document.getElementById('number-form-inp').value;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '/script/ajax/post_comments.php');

        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                get_comment();
            }
        }
        xhr.send('aside-data-number-inp=' + number_form_inp);
        document.getElementById('number-form-inp').value = "";
    }

    company_form.onsubmit = function (e) {
        e.preventDefault();
        let company_form_inp = document.getElementById('company-form-inp').value;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '/script/ajax/post_comments.php');

        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                get_comment();
            }
        }
        xhr.send('aside-data-company-inp=' + company_form_inp);
        document.getElementById('company-form-inp').value = "";
    }
    aside_company.style.display = 'block';
}


