var folder_name = document.getElementById("folder_name").value
console.log(folder_name)





document.getElementsByName("deleteBtn").onclick = function() {

    // alert("button was clicked");
    if (confirm("Do you want to delete the file")){
        window.location.href = "delete.php?folder_name=" + folder_name;
        console.log("loaded");
        }




}


function getIndex(x){
    if (confirm("Do you want to delete the file")){
        window.location.href = "delete.php?folder_name=" + folder_name;
        console.log("loaded");
    }
    var row_number = x.rowIndex;
    var column_name = x.cellsIndex;
    document.getElementById('index').textContent = row_number;
}



var table = document.getElementById("file_table").onclick = function() {
// var rowCount = table.rows.length;        
for (var i = 0; i < table.rows.length; i++) {
    table.rows[i].onclick = function() {
        //rIndex = this.rowIndex;
        console.log(this.cells[0].innerHTML);
}

}


let myTable = document.getElementById('file_table').onclick=function() {

    for (let row of myTable.rows) {
        for(let cell of row.cells){
        console.log(cell.innerText);
        }
}

}

