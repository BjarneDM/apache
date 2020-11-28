var alfabet = "aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ.@1234567890-_"

function encode()
{
}

function decode(email,href,title,inner)
{
    var nyEpost = "" ;
    var i, j, position, ePosten, nyPosition, nyEpostText
    var skjulte = document.getElementsByName(email) ;
    for (i=0 ; i<skjulte.length ; i++)
    {
        nyEpost = "" ;
        ePosten = skjulte[i] ;
        for (j=0 ; j<ePosten.title.length ; j++)
        {
            position = alfabet.indexOf(ePosten.title.charAt(j)) ;
            if ( position >= 0 ) 
            {
                nyPosition = (position+(alfabet.length/2)) % alfabet.length ;
                nyEpost += alfabet.charAt(nyPosition)
            }
            else
            {
                nyEpost += ePosten.title.charAt(j)
            }
        }
        if ( href )  { ePosten.href  = "mailto:"+nyEpost }
        if ( title ) { ePosten.title = nyEpost } else { ePosten.title = '' }
        if ( inner ) 
        {
        	nyEpostText = document.createTextNode(nyEpost) ;
        	ePosten.appendChild(nyEpostText) ;
        }
    }
}

function generate()
{
}
