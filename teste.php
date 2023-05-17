<div class="w-100 text-end"><button class="bg-success rounded-3 rounded-2 px-4 py-2 text-white" onclick="excel()">Exportar Inscritos</button></div>
<?php
global $wpdb;
$lista = $wpdb->get_results("SELECT * FROM wpup_users_cadastro ORDER BY id_cadastro ASC ");
echo"<table class='w-100' id='employee_data'>";
$cont=1;
foreach($lista as $value){
$userId= $value->id_cadastro;
$nome=$value->nomeCompleto;
$email=$value->email;
$cpf=$value->cpf;
$status=$value->status;
echo"
<tr>
<td class='table-user' >
$cont
</td>
<td class='table-user'>
";

if($status==1){
echo"<span class='bg-success text-white font-weight-bold p-2 rounded-2'>A</span>";
}else{
    echo"<span class='bg-danger text-white font-weight-bold p-2 rounded-2'>R</span>"; 
}
echo"
</td>
<td class='table-user'>
$nome
</td>
<td class='table-user'>
$cpf
</td>
<td class='table-user'>
$email
</td>

<td class='table-user'>
<form method='post'>
<label for='exclui$userId' style='color:red'><i class='fa-sharp fa-solid fa-trash'></i></label>
 <input type='submit' class='d-none' id='exclui$userId' value='excluir' name='exclui$userId'>
 </form>
</td>

<td class='table-user'>
<a href='https://luziania.prevestibularsocial.com.br/validacao-inscrito/?cpf=$cpf' class='but-inscrito'>Ver inscrito</a>
</td>

</tr>";
if (isset($_POST['exclui'.$userId])) {
    $wpdb->delete('wpup_users_cadastro', array(
        'id_cadastro' => $userId,
    ));
            echo "<script>
        window.location.replace('https://luziania.prevestibularsocial.com.br/dashboard');
        </script>
        ";
}
$cont++;
}

?>
</table>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script>
function excel(){
        html_table_to_excel('xlsx');
}
    function html_table_to_excel(type) {
  
        var data = document.getElementById('employee_data');

        var file = XLSX.utils.table_to_book(data, {
            sheet: 'sheet1'
        });

        XLSX.write(file, {
            bookType: type,
            bookSST: true,
            type: 'base64'
        });

        XLSX.writeFile(file, 'Inscritos.' + type);
    }

  

</script>