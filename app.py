from flask import Flask, request, jsonify, render_template

app = Flask(__name__)

# Funções para classificar cada variável
def classify_hemoglobina(value):
    if value < 12:
        return 'Baixo'
    elif value > 16:
        return 'Alto'
    else:
        return 'Normal'

def classify_ferritina(value):
    if value < 50:
        return 'Baixo'
    elif value > 150:
        return 'Alto'
    else:
        return 'Normal'

def classify_albumina(value):
    if value < 3.5:
        return 'Baixo'
    elif value > 5.0:
        return 'Alto'
    else:
        return 'Normal'

def classify_vitamina_b12(value):
    if value < 200:
        return 'Baixo'
    elif value > 900:
        return 'Alto'
    else:
        return 'Normal'

def classify_vitamina_d(value):
    if value < 20:
        return 'Baixo'
    elif value > 50:
        return 'Alto'
    else:
        return 'Normal'

def classify_calcio(value):
    if value < 8.5:
        return 'Baixo'
    elif value > 10.2:
        return 'Alto'
    else:
        return 'Normal'

def classify_zinco(value):
    if value < 70:
        return 'Baixo'
    elif value > 120:
        return 'Alto'
    else:
        return 'Normal'

# Função para prever novos dados
def predict_class(hemoglobina, ferritina, albumina, vitamina_b12, vitamina_d, calcio, zinco):
    hemoglobina_class = classify_hemoglobina(hemoglobina)
    ferritina_class = classify_ferritina(ferritina)
    albumina_class = classify_albumina(albumina)
    vitamina_b12_class = classify_vitamina_b12(vitamina_b12)
    vitamina_d_class = classify_vitamina_d(vitamina_d)
    calcio_class = classify_calcio(calcio)
    zinco_class = classify_zinco(zinco)
    
    return {
        'Hemoglobina': hemoglobina_class,
        'Ferritina': ferritina_class,
        'Albumina': albumina_class,
        'Vitamina B12': vitamina_b12_class,
        'Vitamina D': vitamina_d_class,
        'Cálcio': calcio_class,
        'Zinco': zinco_class
    }

@app.route('/')
def index():
    return redirect(url_for('static', filename='novaRec.php'))

@app.route('/predict', methods=['POST'])
def predict():
    try:
        hemoglobina = float(request.form['hemoglobina'])
        ferritina = float(request.form['ferritina'])
        albumina = float(request.form['albumina'])
        vitamina_b12 = float(request.form['vitamina_b12'])
        vitamina_d = float(request.form['vitamina_d'])
        calcio = float(request.form['calcio'])
        zinco = float(request.form['zinco'])
        
        resultados = predict_class(hemoglobina, ferritina, albumina, vitamina_b12, vitamina_d, calcio, zinco)
        
        return jsonify({'status': 'success', 'resultados': resultados})
    except Exception as e:
        return jsonify({'status': 'error', 'message': str(e)})

if __name__ == '__main__':
    app.run(debug=True, port=8081)
