(() => {
    preventRightClicksOnTable();
    addStylingToMineSweeperCells();
    addFlagsOnRightClick();

    function addFlagsOnRightClick() {
        var cells = document.querySelectorAll('.mineSweeperCell');
        cells.forEach((cell) => {
            cell.addEventListener("mousedown", (event) => {
                var form = cell.parentNode;
                if (event.which === 3) {
                    if (cell.value == " ") {
                        cell.value = "-";
                        form.flagged.value = "1";
                    } else {
                        cell.value = " ";
                        form.flagged.value = "0";
                    }
                    form.action = '?route=minesweeper/setflag';
                    form.submit();
                }
            })
        });
    }

    function preventRightClicksOnTable() {
        var table = document.querySelector('#mineSweeper');
        table.addEventListener('contextmenu', event => event.preventDefault());
    }

    function addStylingToMineSweeperCells() {
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
    }
})();