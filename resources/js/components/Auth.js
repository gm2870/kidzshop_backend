import Axios from "axios";

$('#register_btn').on('click', e => {
    e.preventDefault();
    const data = {

    };
    Axios.post('/register');
})


$('#login_btn').on('click', e => {
    alert('login');
    e.preventDefault();
    // const data = {
        
    // };
    // Axios.post('/login');
})