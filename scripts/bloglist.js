let x,y;//next and previous place holder
const View ={
  //paginator View
  container: document.getElementById('paginationContainer'),
  nextPage: document.getElementById('next'),
  currentPage: document.getElementById('current').value,//returns the current page num as sent from the server
  previousPage: document.getElementById('prev'),
  total: document.getElementById("total").value,//returns the total number of pages
  display(target)
  {
    target.style.display = 'block';
  },
  hide(target)
  {
    target.style.display = 'none';
  },
  pageStatus(target,value,args)
  {
    target = Number(target);
    value = Number(value);
    if (target === value) {
      this.hide(args);
    }else{
      this.display(args);
    }
  },
  pageNotFound(target,value)
  {
    if(target > value){
      this.hide(this.previousPage);
      this.hide(this.nextPage);
    }
  }
};

//paginator object
const paginator ={
  createPageLink(container,page,nextPage,num)
  {
    for(let i=0;i<num;i++){
      const pageNum = document.createElement("a");
      pageNum.textContent = page+i;
      pageNum.href ="?route=article/blog&page="+(page+i);
      pageNum.classList.add('pagination');
      container.insertBefore(pageNum,nextPage);
    }
  },
  /*
  accepts the current page number returned by the server
  if the current page number is less than one, then it is the first page

  else check the page and display the correct paginated numbering
  Note: i is set to numbers to appear in the pagination tab
  */
  paginatePage(currentPage)
  {
    let page;//initialize page num
    if((Number(currentPage) /2) <= 1){//first page
      page = 1;
      this.createPageLink(View.container,page,View.nextPage,2);
    }else{
     page = Number(currentPage);
      if(page >= View.total){
        this.createPageLink(View.container,page,View.nextPage,((page==View.total)?1:0));
      }
    }
    x = View.previousPage.nextElementSibling.textContent;
    y = View.nextPage.previousElementSibling.textContent;
    View.pageStatus(x,1,View.previousPage);
    View.pageStatus(y,View.total,View.nextPage);
    View.pageNotFound(View.currentPage,View.total);
  },
  getPage(e)//renders the previous or next page
  {
    const value = e.target.id;//returns the id for either the next/previous button
    switch(value){
      case 'prev':
        View.previousPage.href="?route=article/blog&page="+((x==1)?Number(x) : (Number(x)-1));
        break;
      case 'next':
        View.nextPage.href="?route=article/blog&page="+(Number(y)+1);
        break;
    }
  },
  pageStatus(target,value,args)
  {
    target = Number(target);
    value = Number(value);
    if (target === value) {
      View.hide(args);
    }else{
      View.display(args);
    }
  },
  pageNotFound(target,value)
  {
    if(target > value){
      View.hide(View.previousPage);
      View.hide(View.nextPage);
    }
  }
};


View.container.addEventListener('click',(e)=>paginator.getPage(e),true);
paginator.paginatePage(View.currentPage);