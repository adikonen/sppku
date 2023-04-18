function handleClick(button, message = 'Apakah anda yakin untuk menghapus data ini?') {
    const isYes = confirm(message);
    if (isYes) {
        button.parentElement.submit();
    } 
}