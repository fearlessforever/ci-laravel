function fetchAjax(options={})
{
    return new Promise((resolve,reject)=>{
      let option = Object.assign({},{
        success:function(res){
          if(res.status && res.status == 'error')
          {
            reject(res);
          }
          resolve(res);
        },error:function(xhr){
          reject(xhr.responseJSON);
        }
      },options);
      $.ajax(option)
    });
  }

var entityMap = {
  '&': '&amp;',
  '<': '&lt;',
  '>': '&gt;',
  '"': '&quot;',
  "'": '&#39;',
  '/': '&#x2F;',
  '`': '&#x60;',
  '=': '&#x3D;'
};

function escapeHtml (string) {
  return String(string).replace(/[&<>"'`=\/]/g, function (s) {
    return entityMap[s];
  });
}

function Modal( element , target ){
  this.element = element;
  if($( '#'+this.element ).length < 1)
  {
    target = (typeof target !== 'undefined' ) ? target : 'body' ;
    $( target).append(`
      <div id="${element}" class="modal fade" role="dialog" data-backdrop="static" >
        <div class="modal-dialog modal-lg" >
        <div class="modal-content"> 
          <div class="modal-header"><div></div><button type="button" class="close" data-dismiss="modal">&times;</button> </div>
          <div class="modal-body"></div> 
          <div class="modal-footer"><div></div><button type="button" class="btn btn-default" data-dismiss="modal">Close</button> </div>
        </div>
        </div>
      </div>
    `);
  }
  this.header = ( str ) => {
    $( '#'+this.element +' .modal-header div' ).html(str);
    return this;
  }
  this.body = ( str ) => {
    $( '#'+this.element +' .modal-body' ).html(str);
    return this;
  }
  this.footer = ( str ) => {
    $( '#'+this.element +' .modal-footer div' ).html(str);
    return this;
  }
  this.show = ( ) => {
    if(typeof $('#'+this.element).modal === 'function')
    {
      $('#'+this.element).modal({show:true});
    }
    return this;    
  }
  this.hide = () => {
    if(typeof $('#'+this.element).modal === 'function')
    {
      $('#'+this.element).modal({show:false});
    }
    return this;   
  }
}