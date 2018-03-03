//pagination script
  var container = document.getElementById('paginationContainer');
  var next = document.getElementById('next');
  var current = document.getElementById('current').value;
  var prev = document.getElementById('prev');
  var total = document.getElementById("total").value;
  var pagination = document.getElementsByClassName('pagination');
  set();
  var y,x;

    container.onclick=function(e){

      var val = e.target.id;
      if (val == 'prev') {
        var counter = x;
       prev.href="?route=article/blog&page="+((counter==1)?Number(counter) : (Number(counter)-1));
      }else if(val == 'next'){
        counter = y;
        next.href="?route=article/blog&page="+(Number(counter)+1);
      }

    }


       total = Number(total);
       current = Number(current);
      if (x==1) {
        prev.style.display = 'none';
      }else{
        prev.style.display = 'block';
      }
      if(y == total){
        next.style.display = 'none';
      }else{
        next.style.display = 'block';
      }
      if(current > total){
          prev.style.display = 'none';
          next.style.display ='none';
        }

    function set(){
         var page = 1;
        if((Number(current) /2) <=1){
          for(var i =0 ;i<2;i++){
            var pikin = document.createElement("a");
            pikin.textContent = page+i;
            pikin.href ="?route=article/blog&page="+(page+i);
            pikin.className = 'pagination';
            container.insertBefore(pikin,next);
            }
        }else{
          page = ((Math.floor(Number(current)/2))*2)+ (Math.floor(Number(current)%2));
                for(var i =0;i<2;i++){
                  if(page+i <= total){
            var pikin = document.createElement("a");
            pikin.textContent =page+i;
            pikin.href ="?route=article/blog&page="+(page+i);
            pikin.className = 'pagination';
            container.insertBefore(pikin,next);
              }
            }
        }
      x = prev.nextElementSibling.textContent;
      y = next.previousElementSibling.textContent;

    }