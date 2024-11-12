const messages = [
    {
        message: '%cHold Up!',
        style: 'color: #5955B2; font-size: 50px; font-weight: bold; text-shadow: 2px 2px black;'
    },
    {
        message: 'Jika seseorang menyuruh Anda untuk menyalin/menempel sesuatu di sini, Anda memiliki peluang 11/10 bahwa Anda sedang ditipu',
        style: ''
    },
    {
        message: '%cMenempelkan apa pun di sini dapat memberi penyerang akses ke akun Anda.',
        style: 'color: #EF0103; font-size: 15px; font-weight: bold;'
    },
    {
        message: 'Kecuali Anda benar-benar paham apa yang Anda lakukan, tutup halaman ini dan tetaplah aman.',
        style: ''
    },
    {
        message: 'Jika Anda benar-benar mengerti apa yang Anda lakukan, Anda harus bekerja sama dengan kami',
        style: ''
    }
];

messages.forEach(data => console.log(data.message, data.style));
