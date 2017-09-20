# -*- coding: utf-8 -*-

from sys import path
path.append('/home/gramz/sitiopy/app')

from sitioweb import contactos, ejemplos, formulario


def application(environ, start_response):
    peticion = environ['REQUEST_URI']
    parametros = environ['QUERY_STRING']

    if peticion.startswith('/contacto'):
        output = contacto.saludo()
    elif peticion.startswith('/ejemplos'):
        output = ejemplos.variable()
    elif peticion.startswith('/tabla'):
        output = ejemplos.tabla()
    elif peticion.startswith('/formulario'):
        output = formulario.envia()
    elif peticion.startswith ('/recibe'):
        output = formulario.recibe(environ)
    else:
        output = "No se a dónde acceder!!"


    start_response('200 OK', [('Content-Type', 'text/html; charset=utf-8')])
    return output
