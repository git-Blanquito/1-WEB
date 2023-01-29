window.addEventListener("load", load);

function load() {
    let node;
    node = document.querySelector( "input[name='busqueda']" );
    node.addEventListener( "input", beginSearch );            
    node.addEventListener( "keydown", beginSearchSynchronous );
}

function  beginSearchSynchronous( event ) {
    if ( event.keyCode === 13 ) {
        location.href = `find.php?q=${this.value}`;
    }
}

function beginSearch () {
    const itemToSearch = this.value;
    if ( itemToSearch !== "" ) {
        const datos = {
            action          : "beginSearch",
            itemToSearch    : itemToSearch
        }; 
        $.ajax ( {
            url: "Ajax/Ajax.php",
            type: "POST",
            data: datos,
            error: function() {
                alert ("Se ha producido un error.");
            },
            success: function ( dataServer ) {
                let data_html;
                let node;
				console.log ( dataServer );
                const objDataServer = JSON.parse( dataServer );
				console.log ( objDataServer );
                data_html = mod004_setOverlaySearch( objDataServer );
                node = document.querySelector( "input[name='busqueda']" );
                destroyOverlaySearch ();
                node.insertAdjacentHTML( "afterend", data_html );      
                node = document.querySelector ( ".main" );
                node.addEventListener( "click", destroyOverlaySearch );
            }
        });
    } else {
        node = document.querySelector( "input[name='busqueda']" );
        destroyOverlaySearch ();
    }
}

function destroyOverlaySearch () {
    let node = document.querySelector( ".overlaysearch" );
    if ( node !== null ) {
        node.remove();
    }
    this.removeEventListener( "click", destroyOverlaySearch );
}

function mod004_setOverlaySearch( objDataServer ) { 
    overlaySearch = "<div class='overlaysearch'>";
    if ( objDataServer.length !== 0 ) {
        objDataServer["data"].forEach(element => {
            if ( typeof element.idHealer !== "undefined" ) {
                overlaySearch+= `<a href='InfoHealer.php?idHealer=${element.idHealer}'>`;
                overlaySearch+=     `<div class='item'>`;
                overlaySearch+=         `<h5>${element.nameHealer}</h5>`;
                overlaySearch+=     `</div>`;
                overlaySearch+= `</a>`;
            }
        });
    } else {
        overlaySearch+=     `<a><div class='item'>`;
        overlaySearch+=         `<p>No hay datos.</p>`;
        overlaySearch+=     `</div></a>`;
    }
    overlaySearch+= `</div>`;
    return overlaySearch;
}
