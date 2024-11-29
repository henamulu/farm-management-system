import React from 'react';
import { render, screen, fireEvent, waitFor } from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import FarmManagement from '../../resources/js/components/FarmManagement';
import axios from 'axios';

jest.mock('axios');

describe('FarmManagement Component', () => {
    beforeEach(() => {
        // Mock de axios
        (axios.get as jest.Mock).mockResolvedValue({
            data: {
                data: [
                    {
                        id: 1,
                        name: 'Test Farm',
                        location: 'Test Location',
                        size: 100.5
                    }
                ]
            }
        });
    });

    it('renders farm list correctly', async () => {
        render(<FarmManagement />);

        await waitFor(() => {
            expect(screen.getByText('Test Farm')).toBeInTheDocument();
        });
    });

    it('can create new farm', async () => {
        (axios.post as jest.Mock).mockResolvedValue({
            data: {
                message: 'Granja creada exitosamente',
                data: {
                    id: 2,
                    name: 'New Farm',
                    location: 'New Location',
                    size: 150
                }
            }
        });

        render(<FarmManagement />);

        // Llenar formulario
        await userEvent.type(screen.getByLabelText('Nombre'), 'New Farm');
        await userEvent.type(screen.getByLabelText('Ubicación'), 'New Location');
        await userEvent.type(screen.getByLabelText('Tamaño'), '150');

        // Enviar formulario
        fireEvent.click(screen.getByText('Crear Granja'));

        await waitFor(() => {
            expect(axios.post).toHaveBeenCalledWith('/api/farms', {
                name: 'New Farm',
                location: 'New Location',
                size: 150
            });
        });
    });

    it('shows error message on failed request', async () => {
        (axios.post as jest.Mock).mockRejectedValue({
            response: {
                data: {
                    message: 'Error al crear granja'
                }
            }
        });

        render(<FarmManagement />);

        fireEvent.click(screen.getByText('Crear Granja'));

        await waitFor(() => {
            expect(screen.getByText('Error al crear granja')).toBeInTheDocument();
        });
    });
}); 