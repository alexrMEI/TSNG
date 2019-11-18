from flask import Flask, render_template, request

global texto = asd

app = Flask(__name__)
@app.route('/')
def index():
    templateData = {
        'texto': texto
    }
    return render_template('index.html', **templateData)

@app.route('/<variavel>')
def action(variavel):
    texto = variavel
    templateData = {
        'texto': texto
    }
    return render_template('index.html', **templateData)

if __name__ == '__main__':
    app.run(debug=True, port=80, host='0.0.0.0')



#página Index tem de estar numa pasta /home/pi/templates