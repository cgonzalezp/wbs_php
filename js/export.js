function imprSelec(overflow)
{
var ficha=document.getElementById(overflow);
var ventimp=window.open(' ','popimpr');
ventimp.document.write(ficha.innerHTML);
ventimp.document.close();
ventimp.print();
ventimp.close();
}