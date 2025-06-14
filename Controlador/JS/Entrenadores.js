// Obtener el contenedor de los entrenadores
var trainersContainer = document.getElementById('trainers-container');

// Datos de los entrenadores (puedes reemplazar estos datos con los reales)
var trainersData = [
  {
    name: 'Entrenador Jordan de las Casas',
    Text: 'Soy especializado en ejercicio cardiovascular con 14 años de experiencia como Entrenador a su servicio.',
    image: '../../Controlador/IMAGENES/Entrenador1.jpg'
    
  },
  {
    name: 'Entrenador Antony Valencia del Carmen',
    Text: 'Soy entrenador fitness especializado en el entrenamiento con pesas que me encargo de guiar y enseñar ejercicios de peso con la utilización de mancuernas, discos, pesas, etc.',
    image: '../../Controlador/IMAGENES/Entrenador2.jpg'
  },
  
  {
    name: 'Entrenador Ezequiel Montenegro',
    Text: 'Soy un profesor especializado y capacitado en preparar y motivar a nuestros clientes para que realicen cada ejercicio de la forma adecuada y con una correcta técnica',
    image: '../../Controlador/IMAGENES/Entrenador3.jpg'
  },
  {
    name: 'Instructora Juanita Sinfuentes',
    Text: 'Soy intructora en Ayudar y Ofrecer técnicas avanzadas aplicada a los ejercicios para una mejor rutina',
    image: '../../Controlador/IMAGENES/Entrenador4.jpg'
  },
  {
    name: 'Entrenador Sergio Bustamante',
    Text: 'Soy entrenador de carreras y triatlones para profesionales con conocimientos en deportes olímpicos que se dedica a entrenar y motivar a quienes desean participar en uno de ellos',
    image: '../../Controlador/IMAGENES/Entrenador5.jpg'
  },
  {
    name: 'Entrenadora Maria Mariela Paredes',
    Text: 'Soy entrenadora de boxeo y me encargo de dar instrucciones a los clientes durante el entrenamiento y enseñarles las técnicas de boxeo, como la defensa y diferentes tipos de golpes.',
    image: '../../Controlador/IMAGENES/Entrenador6.jpg'
  },
  {
    name: 'Entrenadora Maricielo Salcedo',
    Text: 'Soy entrenadora fisica que me enfoco en empujar a sus clientes a lograr una variedad de objetivos físicos ofreciendo asistencia práctica en los entrenamientos.',
    image: '../../Controlador/IMAGENES/Entrenador7.jpg'
  },
  {
    name: 'Instructora en entrenamiento metabólico',
    Text: 'Soy intructora de guiar una serie de ejercicios que aumentan el consumo de calorías mediante el incremento de la tasa metabólica (quema de calorías).',
    image: '../../Controlador/IMAGENES/Entrenador8.jpg'
  },
  {
    name: 'Instructora Maria del Pilar Cerron',
    Text: 'Soy instructora de pilates que me encargo de enseñar ejercicios y técnicas de pilates orientados a aumentar el control, fuerza y flexibilidad del cuerpo.',
    image: '../../Controlador/IMAGENES/Entrenador9.jpg'
  },
  {
    name: 'Entrenador Juan de Dios Martinez',
    Text: 'Soy un entrenador de alto rendimiento que se encarga de programar el entrenamiento de los clientes para obtener el máximo de sus capacidades físicas.',
    image: '../../Controlador/IMAGENES/Entrenador10.jpg'
  },
  {
    name: 'Entrenadora Xiomara Pereda',
    Text: 'Soy la principal encargada de la dirección y entrenamiento del boxeador, cuadrilátero o ring.',
    image: '../../Controlador/IMAGENES/Entrenador11.jpg'
  },
  {
    name: 'Entrenadora Madeleine Rojas',
    Text: 'Soy entrenadora funcional que se encarga de un conjunto de ejercicios capaces de mejorar la función de cada una de las articulaciones y corregirlas.',
    image: '../../Controlador/IMAGENES/Entrenador12.jpg'
  }

];


// Generar el HTML de los entrenadores
trainersData.forEach(function(trainer) {
  var trainerHTML =
    '<div class="trainer">' +
      '<div class="trainer-details">' +
        '<h3>' + trainer.name + '</h3>' +
        '<p>' + trainer.Text + '</p>' +
      '</div>' +
      '<img src="' + trainer.image + '" alt="' + trainer.name + '">' +
    '</div>';

  trainersContainer.innerHTML += trainerHTML;
});
