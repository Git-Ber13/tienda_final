export async function obtenerFraseAleatoria() {
    try {
        // Realizamos la llamada a la API
        const response = await fetch('http://127.0.0.1:8000/api/frases');
        const data = await response.json();

        // Imprimimos la respuesta de la API en la consola para verificar
        console.log('Respuesta de la API:', data);

        // Verificamos que las frases existan en el campo 'member' de la respuesta
        if (data.member && data.member.length > 0) {
            // Seleccionamos una frase aleatoria desde el array 'member'
            const randomIndex = Math.floor(Math.random() * data.member.length);
            const fraseAleatoria = data.member[randomIndex].cita; // Accedemos a la propiedad 'cita'

            // Devolvemos la frase aleatoria
            return fraseAleatoria;
        } else {
            console.error('No se encontraron frases en la respuesta.');
            return 'No hay frases disponibles.';
        }
    } catch (error) {
        console.error('Error al obtener las frases:', error);
        return 'Error al obtener frase.';
    }
}
