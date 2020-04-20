import React, { useState } from 'react';

const Form = (props) => {
    return (
        <div>
            <div class="input-field col s12">
                <select>
                    <option value="" disabled selected>Pasirinkite Formatą</option>
                    <option value="1">Atari 2600</option>
                    <option value="2">NES / Famicom / Klonai</option>
                    <option value="3">Sega Mega Drive / Genesis</option>
                </select>
                <label>Formatas</label>
            </div>
            <div className="input-field col s12">
                    <input 
                        placeholder="Pavadinimas" 
                        className="newHabit-input"     
                        />
                </div>
            </div>
    );
}

export default Form;