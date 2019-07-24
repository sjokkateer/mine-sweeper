(() => {
    var cells = document.querySelectorAll('.mineSweeperCell');
    cells.forEach((cell) => {
        cell.style['font-weight'] = 'bold';
        switch(cell.value) {
            case "1":
                cell.style.color = 'blue';
                break;
            case "2":
                cell.style.color = 'green';
                break;
            case "3":
                cell.style.color = 'red';
                break;
            case "4":
                cell.style.color = 'purple';
                break;
            case "5":
                cell.style.color = 'maroon';
                break;
            case "6":
                cell.style.color = 'turqoise';
                break;
            case "*":
            case "7":
                cell.style.color = 'black';
                break;
            case "8":
                cell.style.color = 'gray';
                break;
        }
    });
})();