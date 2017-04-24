require 'DB.php';
$d = DB::connect('oci8://acct1:pass12@www.host.com/dbname');
if (DB::isError($d)) { die("cannot connect – " . $d->getMessage()); }
$d->setErrorHandling(PEAR_ERROR_DIE);
...
$q = $d->query('SELECT Name, Dno FROM EMPLOYEE');
while ($r = $q->fetchRow()) {
print "employee $r[0] works for department $r[1] \n" ;
}
...
$q = $d->query('SELECT Name FROM EMPLOYEE WHERE Job = ? AND Dno = ?',
array($_POST['emp_job'], $_POST['emp_dno']) );
print "employees in dept $_POST['emp_dno'] whose job is
$_POST['emp_job']: \n"
while ($r = $q->fetchRow()) {
print "employee $r[0] \n" ;
}
...
$allresult = $d->getAll('SELECT Name, Job, Dno FROM EMPLOYEE');
foreach ($allresult as $r) {
print "employee $r[0] has job $r[1] and works for department $r[2] \n" ;
}