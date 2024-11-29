import React, { useEffect } from 'react';
import SwaggerUI from 'swagger-ui-react';
import 'swagger-ui-react/swagger-ui.css';

const ApiDocViewer: React.FC = () => {
    useEffect(() => {
        // Cargar configuración de Swagger
        const loadSwaggerConfig = async () => {
            try {
                const response = await fetch('/api/documentation');
                const spec = await response.json();
                
                // Configurar Swagger UI
                const ui = SwaggerUI({
                    spec,
                    dom_id: '#swagger-ui',
                    deepLinking: true,
                    presets: [
                        SwaggerUI.presets.apis,
                        SwaggerUI.SwaggerUIStandalonePreset
                    ],
                    plugins: [
                        SwaggerUI.plugins.DownloadUrl
                    ],
                    layout: "BaseLayout",
                    supportedSubmitMethods: ['get', 'post', 'put', 'delete', 'patch'],
                });
            } catch (error) {
                console.error('Error al cargar la documentación:', error);
            }
        };

        loadSwaggerConfig();
    }, []);

    return (
        <div className="p-4">
            <h2 className="text-2xl mb-4">Documentación de la API</h2>
            <div id="swagger-ui" className="swagger-ui">
                {/* Swagger UI se renderizará aquí */}
            </div>
        </div>
    );
};

export default ApiDocViewer; 