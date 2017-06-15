
(function($) {
    $.fn.goTo = function() {
        $('html, body').animate({
            scrollTop: $(this).offset().top + 'px'
        }, 'fast');
        return this; // for chaining...
    }
})(jQuery);



$( document ).ready(function() 
{
    var count = 0;
    setInterval(function() 
    {
        var e = 12;
        var t = 16;
        var o = count * -t;
        $(".ajax-spinner").css(
        {
            backgroundPosition: o + "px 0px"
        });

        count++;
        count >= e && (count = 0)
    }, 100)

    $(".modal form").submit( function(e) 
    {
        e.preventDefault()
    })

    $(".modal").click(function(e) 
    {
        if( !$(this).hasClass("modal-busy") )
        {
            !$(e.target).is(".modal") && !$(e.target).is(".modal-close") || $(this).removeClass("modal-active")
        }
    })

    /* Click en Logearse */
    $(".login-nav-btn").click( function() 
    {
        $('#myModal').modal('show');
        $("#modal-login").addClass("selected").siblings().removeClass("selected")
        $(".modal-login-content").show().siblings().hide()

        //console.log('Aprete Login!!')
    })

    /* Click en Registrarse */
    $(".register-nav-btn").click( function() 
    {
        $('#myModal').modal('show');
        $("#modal-register").addClass("selected").siblings().removeClass("selected")
        $(".modal-register-content").show().siblings().hide()

        //console.log('Aprete Registrar!!')
    })

    /* Click en me olvide la contraseña */
    $(".forgotpassword-nav-btn").click( function() 
    {
        $(".modal-forgotpass-content").show().siblings().hide()
    })

    $("#modal-login").click( function() 
    {
        $(this).addClass("selected").siblings().removeClass("selected")
        $(".modal-login-content").show().siblings().hide()
    })

    $("#modal-register").click(function() 
    {
        $(this).addClass("selected").siblings().removeClass("selected"), 
        $(".modal-register-content").show().siblings().hide()
    })


    // Enter en Login
    $(".modal-login-content input").keydown( function(e) 
    {
        13 == e.keyCode && $(".modal-login-content button").trigger("click")
    })

    $(".modal-login-content button").click(function() 
    {
        $(".modal-login-content .error-msg").text("")
        $(".modal-loading-content").show().siblings().hide();

        var data = 
        {
            username: $(".modal-login-content input[name='username']").val(),
            password: $(".modal-login-content input[name='password']").val()
        };

        $.ajax(
        {
            url: "/pelis/ajax/login",
            data: data,
            type: "POST",
            success: function(e) 
            {
                if( "ok" == e.status )
                {
                    window.location.reload()
                }
                else
                {
                    $(".modal-login-content input[name='password']").val("")
                    $(".modal-login-content .error-msg").text("Error: " + e.message)
                    $(".modal-login-content").show().siblings().hide() 
                }
            },
            error: function(e) 
            {
                if( 0 == e.status )
                {
                    e.statusText = "Page did not respond"
                }

                $(".modal-login-content input[name='password']").val("")
                $(".modal-login-content .error-msg").text("Error: " + e.statusText + " (Code " + e.status + ")")
                $(".modal-login-content").show().siblings().hide()
            }
        })
    })

    // Enter en Registrarse
    $(".modal-register-content input").keydown( function(e) 
    {
        if( 13 == e.keyCode )
        {
            $(".modal-register-content button").trigger("click")
        }
    })
    
    $(".modal-register-content button").click( function() 
    {
        // Esconde lo demas

        var errorMsg = $(".modal-register-content .error-msg")
        errorMsg.text("")

        var firstname               = $(".modal-register-content input[name='firstname']")
        var lastname                = $(".modal-register-content input[name='lastname']")
        var username                = $(".modal-register-content input[name='username']")
        var email                   = $(".modal-register-content input[name='email']")
        var password                = $(".modal-register-content input[name='password']")
        var password_confirmation   = $(".modal-register-content input[name='password_confirmation']")

        // /^([a-zA-Z0-9]{6,})$/.test('')
        // http://stackoverflow.com/questions/11896599/javascript-code-to-check-special-characters
        // /[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test('hola&&')
        // /.{6,}[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test('$$$')
        // /[a-zA-Z0-9]{6,}[^\s]*$/.test('gdfgdf')
        // /^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[\s])(?=.*[@#$%^&+=]).*$/.test('Asd453dfsd ')
        var nameregex = /^[a-zA-Z]+$/;
        var userregex = /^[0-9a-zA-Z]+$/;
        var emailregex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var passwordregex = /^(?=.{6,})(?=.*[a-zA-Z])(?=.*[0-9@#$%^&+=]).*$/;

        if( password.val() != password_confirmation.val() )
        {
            errorMsg.text("Las contraseñas no coinciden")
            password.val("")
            password_confirmation.val("")

            return 0;
        }
        else if( !nameregex.test(firstname.val()) || !nameregex.test(lastname.val()) )
        {
            errorMsg.text("El Nombre y el Apellido no puede ser vacio")

            return 0;
        }
        else if( !userregex.test(username.val() ) )
        {
            errorMsg.text("El nombre se usuario debe tener al menos 6 letras o numeros")

            return 0;
        }
        else if( !(emailregex.test( email.val() )))
        {
            errorMsg.text("El email ingresado es invalido")

            return 0;
        }
        else if( !passwordregex.test( password.val() ) )
        {
            errorMsg.text("La Contraseña debe tener al menos un numero o un caracter especial")

            return 0;
        }

        $(".modal-loading-content").show().siblings().hide();

        var data = 
        {
            firstname:              firstname.val().trim(),
            lastname:               lastname.val().trim(),
            username:               username.val(),
            email:                  email.val(),
            password:               password.val(),
            password_confirmation:  password_confirmation.val(),
        };

        $.ajax(
        {
            url: "/pelis/ajax/register",
            data: data,
            type: "POST",
            success: function(e) 
            {
                if( "ok" == e.status )
                {
                    $(location).attr('href', '')
                    firstname.val("")
                    lastname.val("")
                    username.val("")
                    email.val("")
                    password.val("")
                    password_confirmation.val("")
                    $(".modal-activate-account-content").show().siblings().hide()
                }
                else
                {
                    $(".modal-register-content input[name='password']").val("")
                    $(".modal-register-content input[name='password_confirmation']").val("")
                    errorMsg.text("Error: " + e.message)
                    $(".modal-register-content").show().siblings().hide()
                }
            },
            error: function(e) 
            {
                password.val("")
                password_confirmation.val("")
                $(".modal-register-content .error-msg").text("Error: " + e.statusText + " (Code " + e.status + ")")
                $(".modal-register-content").show().siblings().hide()
            }
        })
    })

    // Se olvido la contraseña?
    $(".modal-forgotpass-content input").keydown( function(e) 
    {
        if( 13 == e.keyCode )
        {
            $(".modal-forgotpass-content button").trigger("click")
        }
    })
    
    $(".modal-forgotpass-content button").click( function() 
    {
        $(".modal-forgotpass-content .error-msg").text("")
        $(".modal-loading-content").show().siblings().hide();

        var data = 
        {
            email: $(".modal-forgotpass-content input[name='email']").val()
        };

        $.ajax(
        {
            url: "/pelis/ajax/forgot-password",
            data: data,
            type: "POST",
            success: function(e) 
            {
                if( "ok" == e.status )
                {
                    window.location.reload()
                }
                else
                {
                    $(".modal-forgotpass-content .error-msg").text("Error: " + e.message)
                    $(".modal-forgotpass-content").show().siblings().hide()
                }
            },
            error: function(e) 
            {
                $(".modal-forgotpass-content .error-msg").text("Error: " + e.statusText + " (Code " + e.status + ")")
                $(".modal-forgotpass-content").show().siblings().hide()
            }
        })
    })

    $("#quick-search-input").click(function() 
    {
        $(".ac-results").css(
        {
            left: $("#quick-search").position().left + 14,
            /*width: */
            width: $("#quick-search").width() - 4
        })
    })

    var quicksearchdefaultvalue = $("#quick-search-input").val();
    $("#quick-search-input").focus(function() 
    {
        if( $("#quick-search-input").val() ==  quicksearchdefaultvalue )
        {
            $("#quick-search-input").val("");
        }
        else
        {
            if( $("#quick-search-input").val().length > 2 && $(".ac-results ul").not(":empty") )
            {
                $(".ac-results").slideDown()
            }
        }

        $(".ac-results").css(
        {
            left: $("#quick-search").position().left + 14,
            width: $("#quick-search").width() - 4
        })

        //console.log( $("#quick-search").width() )
    })

    $("#quick-search-input").blur( function() 
    {
        if( $("#quick-search-input").val().trim() === "" )
        {
            $("#quick-search-input").val(quicksearchdefaultvalue);
        }
    })

    var setTimeoutRestart = function() 
    {
            var h = 0;
            return function(func, timeout) 
            {
                clearTimeout(h)
                h = setTimeout(func, timeout)
            }
     }()

    $("#quick-search-input").keyup( function(e) 
    {
        var kCode = e.keyCode || e.which
        var action = 
        {
                up: 38,
                down: 40,
                left: 37,
                right: 39,
                esc: 27,
                enter: 13
        };

        if (kCode === action.enter || kCode === action.esc || kCode === action.up || kCode === action.down || kCode === action.left || kCode === action.right ) 
            return !1;
        
        var value = $("#quick-search-input").val();
        if( value.length >= 3 )
        {
            // Esperamos medio segundo por las dudas que siga escribiendo
            setTimeoutRestart( function()
            {
                $(".ajax-spinner").fadeIn("fast")
                $.ajax(
                {
                    url: "/pelis/ajax/search",
                    data: 
                    {
                        term : value
                    },
                    type: "GET",
                    success: function(e) 
                    {
                        //console.log(e);

                        var t = "";
                        if( "ok" === e.status )
                        {
                            //console.log("Entre!!")

                            e.data.forEach( function(e) 
                            {
                                t += '<li><a href="' + e.url + '"><img src="' + e.img + '"><span>' + e.title + "</span><p>" + e.year + "</p></a></li>"
                            })
                        } 
                        else
                        {
                            t = '<li class="ac-no-results">' + e.message + "</li>"
                        }

                        $(".ac-results ul").html(t)

                        if( !$(".ac-results").is(":visible") )
                        {
                            $(".ac-results").slideDown()
                        }

                        //$(".ac-results").is(":visible") || $(".ac-results").slideDown()
                        
                        //$(".ac-results ul li:first-child").addClass("ac-item-hover")
                        $(".ac-results ul li:first-child").addClass("ac-item-selected")
                        $(".ajax-spinner").fadeOut("fast")
                    },
                    error: function(e) 
                    {
                        var t = "";
                        t = '<li class="ac-no-results">Error: ' + e.statusText + " (Code " + e.status + ")</li>"
                        $(".ac-results ul").html(t)
                        $(".ac-results").not(":visible") && $(".ac-results").slideDown()
                        $(".ac-results ul li:first-child").addClass("ac-item-selected")
                        $(".ajax-spinner").fadeOut("fast")
                    }
                })
            }, 500)
        }

    })

    $(document).keydown(function(e) 
    {
        if ( $(".ac-results").is(":visible") ) 
        {
            var t = e.keyCode || e.which

            var action = 
            {
                    up: 38,
                    down: 40,
                    esc: 27,
                    enter: 13
            };

            if (t === action.esc) return $(".ac-results").slideUp(), !1;
            
            if ( !$(".ac-results li").hasClass("ac-no-results") ) 
            {
                var n = $(".ac-results"),
                    a = $(".ac-results ul li").hasClass("ac-item-selected"),
                    s = $(".ac-results ul li").first().hasClass("ac-item-selected"),
                    i = $(".ac-results ul li").last().hasClass("ac-item-selected");
                switch (t) {
                    case action.up:
                        if (a) {
                            if (s) {
                                $("li.ac-item-selected", n).removeClass("ac-item-selected"), $("ul li", n).last().addClass("ac-item-selected");
                                break
                            }
                            $("li.ac-item-selected", n).prev().addClass("ac-item-selected"), $("li.ac-item-selected", n).next().removeClass("ac-item-selected")
                        } else $("ul li", n).last().addClass("ac-item-selected");
                        break;
                    case action.down:
                        if (a) {
                            if (i) {
                                $("li.ac-item-selected", n).removeClass("ac-item-selected"), $("ul li", n).first().addClass("ac-item-selected");
                                break
                            }
                            $("li.ac-item-selected", n).next().addClass("ac-item-selected"), $("li.ac-item-selected", n).prev().removeClass("ac-item-selected")
                        } else $("ul li", n).first().addClass("ac-item-selected");
                        break;
                    case action.enter:
                        window.location.href = $("li.ac-item-selected a", n).attr("href")
                }
            }
            }
    })

    $(document).click( function(e) 
    {
        var t = $(e.target);

        if( $(".ac-results").is(":visible") && 0 in t && "quick-search-input" != t[0].id && "a" !== e.target.tagName.toLowerCase() )
        {
            $(".ac-results").slideUp()
        }

        //$(".ac-results").is(":visible") && 0 in t && "quick-search-input" != t[0].id && "a" !== e.target.tagName.toLowerCase() && $(".ac-results").slideUp()
    })

    $(".ac-results ul").on("mouseover", "li", function() 
    {
        $(this).addClass("ac-item-selected").siblings().removeClass("ac-item-selected")
    })


    $(".star-row").click( function(e)
    {
        //console.log(e.target.id);
        var cantStar = e.target.id;
        //var filmid = e.parentNode.
        //var filmid = e.target.parentNode.parentNodedata-movie-id;
        //console.log( $("#movie-info").data("movie-id") )
        var filmid = $("#movie-info").data("movie-id")

        if( cantStar > 0 && cantStar < 6 && filmid > 0 )
        {
            var data = 
            {
                stars:  cantStar,
                id:     filmid
            };

            $.ajax(
            {
                url: "/pelis/ajax/star",
                data: data,
                type: "POST",
                success: function(e) 
                {
                    //console.log('Todo Perfecto')
                    //console.log(e.data)
                    if( "ok" == e.status )
                    {
                        //console.log(e.data.avg)
                        $("#rating-span").text(e.data.avg)

                        //console.log($(".star-row").find('span'))
                        $(".star-row").find('span').each( function(i, e)
                        {
                            //console.log(e)
                            // Acomodar esta funcion!!
                            if( e.id <= cantStar )
                            {
                                $(this).css( "color", "#BBD41C" )
                            }
                            else if( e.id > cantStar )
                            {
                                $(this).css( "color", "")
                            }
                        })
                    }
                    /*else
                    {
                    }*/
                },
                error: function(e) 
                {
                }
            })

        }
    })

    /* Comment Form */
    $('#comment-form').keydown( function(e)
    {
        var kCode = e.keyCode || e.which
        var action = 
        {
                esc: 27,
                enter: 13
        };

        if(kCode !== action.enter ) 
            return 1;
        
        var filmid = $("#movie-info").data("movie-id")
        var value = $("#comment-form").val();

        if( value.length >= 5 )
        {
            var data = 
            {
                comment:    value,
                id:         filmid
            };

            $.ajax(
            {
                url: "/pelis/ajax/comment",
                data: data,
                type: "POST",
                success: function(e) 
                {
                    //console.log(e)
                    if( "ok" == e.status )
                    {
                        var commentId = e.data.id;
                        var userName = e.data.username;
                        var commentNew = e.data.comment;
                        var commentDate = e.data.time;
                        var commentStars = e.data.stars;

                        var cantArticles = $(".comment-list > article").length;
                        $(".comment-list #" + commentId).remove()
                        $("#comment-form").remove()

                        //console.log($(".comment-list > article").length)
                        
                        $(".comment-list").append(' \
                                        <article id="'+ commentId +'" class="row"> \
                                             <div class="col-md-10 col-sm-10"> \
                                             <div class="panel panel-default arrow ' + ((cantArticles % 2) ? 'left' : 'right') + '"> \
                                                <div class="panel-body"> \
                                                    <header class="text-left"> \
                                                        <div class="comment-user"><span class="glyphicon glyphicon-user"></span> ' + userName +'</div> ' +
                                                         ((commentStars > 0) ? '<div class="comment-star"><span class="glyphicon glyphicon-star"></span> ' + commentStars +'</div>' : '') +
                                                        '<div class="comment-date"><span class="glyphicon glyphicon-time"></span> ' + commentDate + '</div> \
                                                    </header> \
                                                <div class="comment-post"> \
                                                    <p>' + commentNew + '</p> \
                                                </div> \
                                                </div> \
                                            </div> \
                                            </div> \
                                        </article>')
                    }
                    /*else
                    {
                    }*/
                },
                error: function(e) 
                {
                    //console.log(e)
                }
            })
        }

        e.preventDefault() // No deja hacer el enter!!

    })

    // Admins AJAX!!

    // Add Film Modal Open!!
    $(".btn.btn-success.btn-film.btn-add").click( function(e)
    {
        //console.log('Click --> Add Film Menu')
        $('#modaladdmovie').modal('show');
    })

    // Cambiar el nombre y guardar en la variable la imagen
    var fileimage;
    $(".image-preview-input input:file").change(function ()
    {
        fileimage = this.files[0];
        //console.log(file.name)
        $(".image-filename").val(fileimage.name);
    });

    // Delete Film Admin Menu!!
    $(".btn.btn-danger.btn-film").click( function(e)
    {
        var conteiner = $(this).parent().parent()
        var filmid = e.target;

        //console.log(conteiner)

        if( filmid.id > 0 )
        {
            var data = 
            {
                action: "delfilm",
                id: filmid.id
            };

            $.ajax(
            {
                url: "/pelis/ajax/admin",
                type: "POST",
                data: data,
                success: function(e) 
                {
                    if( "ok" == e.status )
                    {
                        // Remove that li
                        conteiner.remove();
                    }
                    else
                    {
                    }
                },
                error: function(e) 
                {
                }
            })

        }
    })

    // Summit Modal Add Film
    $(".btn.btn-primary.btn-add").click( function(e)
    {
        var filmname = $("#addname").val()
        var filmyear = $("#addyear").val()
        var filmgene = $("#addgene").val()
        var filmsinop = $("#addsinop").val()

        // Check Form data here!!
        if( fileimage == null )
            return !1;

        //console.log('Agregando ' + filmname + ' ' +  filmsinop)
        
        /*var data = 
        {
            action: "addfilm",
            name: filmname,
            year: filmyear,
            generoid: filmgene,
            sinopsis: filmsinop,
            image: fileimage
        };*/

        var data = new FormData();
        data.append("action", "addfilm")
        data.append("name", filmname)
        data.append("year", filmyear)
        data.append("generoid", filmgene)
        data.append("sinopsis", filmsinop)
        data.append("image", fileimage)

        $.ajax(
        {
            url: "/pelis/ajax/admin",
            type: "POST",
            data: data,
            cache: false,
            /*dataType: 'json',*/
            processData: false,
            contentType: false,
            success: function(e) 
            {
                //console.log( e ) 
                if( "ok" == e.status )
                {
                    var filmid = e.data.id;

                    // Agregar la pelicula al final del todo
                    $("#list-film").append('<li class="list-group-item clearfix"> \
                        <span class="label label-default">'+ filmid +'</span> \
                        <span class="film-info">' + filmname + ' (' + filmyear + ')</span> \
                        <span class="film-edit"></span> \
                        <span class="pull-right button-group"> \
                            <a id="'+ filmid +'" href="javascript:void(0)" class="btn btn-primary btn-film btn-edit"><span class="glyphicon glyphicon-edit"></span> Edit</a> \
                            <a id="'+ filmid +'" href="javascript:void(0)" class="btn btn-danger btn-film"><span class="glyphicon glyphicon-remove"></span> Delete</a> \
                        </span> \
                        <div class="edit-space"></div> \
                    </li>')
                    
                    //console.log( $('<span class="label label-default">'+ filmid +'</span>') )
                    $('#'+ filmid).goTo();
                    $('#modaladdmovie').modal('hide');
                }
                else
                {
                }
            },
            error: function(e) 
            {
                //console.log(e)
            }
        })
    })


    // Edit Film
    $(".btn.btn-primary.btn-film").click( function(e)
    {
        var conteiner = $(this).parent().parent()
        var filmid = e.target;

        if( $(this).hasClass("btn-edit") )
        {
            $(this).removeClass("btn-edit")
            $(this).addClass("btn-accept")

            $(this).html('<span class="glyphicon glyphicon-ok"></span> Accept')
            $(conteiner).find(".film-info").hide()

            $(conteiner).find(".film-edit").html('<div class="input-group"><span class="input-group-addon" id="basic-addon1">@</span><input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1"></div>')
            $(conteiner).find(".film-edit").show()
        }
        else
        {
            $(this).removeClass("btn-accept")
            $(this).addClass("btn-edit")

            $(conteiner).find(".film-edit").hide()

            $(this).html('<span class="glyphicon glyphicon-edit"></span> Edit')
            $(conteiner).find(".film-info").show()
        }
        // console.log( $(this).text() )
        //$(this).html('<span class="glyphicon glyphicon-remove"></span> Aceptar')
        //$(this).append('<span class="glyphicon glyphicon-remove"></span> Accept')
        //$(this).val("Holaaaa")

        //$(conteiner).append('<div><p>Editando</p></div>')
        //$(conteiner).find(".film-info").hide()

    })
});



