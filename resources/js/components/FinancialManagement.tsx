import React, { useState, useEffect } from 'react';
import axios from 'axios';

interface Transaction {
    id: number;
    type: 'income' | 'expense';
    amount: number;
    description: string;
    category: string;
    date: string;
}

const FinancialManagement: React.FC = () => {
    const [transactions, setTransactions] = useState<Transaction[]>([]);
    const [summary, setSummary] = useState({
        totalIncome: 0,
        totalExpenses: 0,
        profit: 0
    });

    const [newTransaction, setNewTransaction] = useState({
        type: 'expense',
        amount: 0,
        description: '',
        category: '',
        date: new Date().toISOString().split('T')[0]
    });

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        try {
            await axios.post('/api/financial/transactions', newTransaction);
            fetchTransactions();
            // Limpiar formulario
            setNewTransaction({
                type: 'expense',
                amount: 0,
                description: '',
                category: '',
                date: new Date().toISOString().split('T')[0]
            });
        } catch (error) {
            console.error('Error al registrar transacción:', error);
        }
    };

    return (
        <div className="p-4">
            <h2 className="text-2xl mb-4">Gestión Financiera</h2>

            {/* Resumen financiero */}
            <div className="grid grid-cols-3 gap-4 mb-8">
                <div className="bg-green-100 p-4 rounded">
                    <h3>Ingresos Totales</h3>
                    <p className="text-2xl">${summary.totalIncome}</p>
                </div>
                <div className="bg-red-100 p-4 rounded">
                    <h3>Gastos Totales</h3>
                    <p className="text-2xl">${summary.totalExpenses}</p>
                </div>
                <div className="bg-blue-100 p-4 rounded">
                    <h3>Beneficio</h3>
                    <p className="text-2xl">${summary.profit}</p>
                </div>
            </div>

            {/* Formulario de nueva transacción */}
            <form onSubmit={handleSubmit} className="mb-8">
                {/* ... campos del formulario ... */}
            </form>

            {/* Lista de transacciones */}
            <div className="overflow-x-auto">
                <table className="min-w-full">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Tipo</th>
                            <th>Categoría</th>
                            <th>Descripción</th>
                            <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        {transactions.map(transaction => (
                            <tr key={transaction.id}>
                                <td>{new Date(transaction.date).toLocaleDateString()}</td>
                                <td>{transaction.type}</td>
                                <td>{transaction.category}</td>
                                <td>{transaction.description}</td>
                                <td className={transaction.type === 'income' ? 'text-green-600' : 'text-red-600'}>
                                    ${transaction.amount}
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </div>
    );
};

export default FinancialManagement; 