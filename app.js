const e=require('express');
const ms=require('mysql');
app=new e();
app.use(e.json());

c=ms.createConnection({
'host':'localhost',
'user':'gyanimzj',
'password':'Nitgyan90!!'
});

c.connect((err)=>{
	if(err)
		throw err;
	console.log('connected to mysql');
})

app.get('/',(req,res)=>{

	res.send('hi there !!');
})
app.listen(8080,()=>{
	console.log('running on 8080');
});
