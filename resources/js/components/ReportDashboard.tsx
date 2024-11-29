import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Line, Bar } from 'react-chartjs-2';
import DatePicker from 'react-datepicker';

interface Report {
    id: number;
    type: 'stock' | 'activity';
    period_start: string;
    period_end: string;
    farm_id: number;
    data: any;
}

const ReportDashboard: React.FC = () => {
    const [reports, setReports] = useState<Report[]>([]);
    const [dateRange, setDateRange] = useState({
        startDate: new Date(),
        endDate: new Date()
    });
    const [selectedFarm, setSelectedFarm] = useState<number>(0);

    const generateReport = async (type: 'stock' | 'activity') => {
        try {
            const response = await axios.post(`/api/reports/${type}`, {
                farm_id: selectedFarm,
                period_start: dateRange.startDate,
                period_end: dateRange.endDate
            });

            // Actualizar lista de reportes
            setReports(prev => [...prev, response.data.data]);
        } catch (error) {
            console.error('Error al generar reporte:', error);
        }
    };

    const downloadPDF = async (reportId: number) => {
        try {
            const response = await axios.get(`/api/reports/${reportId}/download`, {
                responseType: 'blob'
            });
            
            const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', `reporte_${reportId}.pdf`);
            document.body.appendChild(link);
            link.click();
        } catch (error) {
            console.error('Error al descargar PDF:', error);
        }
    };

    return (
        <div className="p-4">
            <h2 className="text-2xl mb-4">Panel de Reportes</h2>

            {/* Controles de generación de reportes */}
            <div className="mb-8 flex gap-4">
                <DatePicker
                    selectsRange
                    startDate={dateRange.startDate}
                    endDate={dateRange.endDate}
                    onChange={(update: [Date, Date]) => {
                        setDateRange({
                            startDate: update[0],
                            endDate: update[1]
                        });
                    }}
                    className="border p-2 rounded"
                />
                
                <button 
                    onClick={() => generateReport('stock')}
                    className="bg-blue-500 text-white px-4 py-2 rounded"
                >
                    Generar Reporte de Stock
                </button>
                
                <button 
                    onClick={() => generateReport('activity')}
                    className="bg-green-500 text-white px-4 py-2 rounded"
                >
                    Generar Reporte de Actividades
                </button>
            </div>

            {/* Lista de reportes */}
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                {reports.map(report => (
                    <div key={report.id} className="border p-4 rounded">
                        <h3 className="font-bold">
                            Reporte de {report.type === 'stock' ? 'Stock' : 'Actividades'}
                        </h3>
                        <p>Período: {new Date(report.period_start).toLocaleDateString()} - 
                           {new Date(report.period_end).toLocaleDateString()}</p>
                        <button 
                            onClick={() => downloadPDF(report.id)}
                            className="mt-2 bg-gray-500 text-white px-3 py-1 rounded"
                        >
                            Descargar PDF
                        </button>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default ReportDashboard; 