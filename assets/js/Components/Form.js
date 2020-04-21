import React, { useState } from 'react';
import { makeStyles } from '@material-ui/core/styles';
import InputLabel from '@material-ui/core/InputLabel';
import MenuItem from '@material-ui/core/MenuItem';
import FormHelperText from '@material-ui/core/FormHelperText';
import FormControl from '@material-ui/core/FormControl';
import Select from '@material-ui/core/Select';

const Form = (props) => {
    return (
        <div>
            <div className="notificationBox-large">
                Reikia įrašyti tik žaidimo pavadinimą, bet jei užpildysite ir kitus laukus, bus lengviau jį rasti
            </div>
            <div className="input-field col s12">
                    <input 
                        placeholder="Pavadinimas *" 
                        className="newHabit-input"     
                        />
                </div>
            <div class="input-field col s6">
                <FormControl>
                    <InputLabel id="demo-simple-select-label">Formatas</InputLabel>
                        <Select
                            labelId="demo-simple-select-label"
                            id="demo-simple-select"
        
                        >
                            <MenuItem value={10}>Atari 2600</MenuItem>
                            <MenuItem value={20}>NES / Famicom / Klonai</MenuItem>
                            <MenuItem value={30}>SNES / Super Famicom</MenuItem>
                            <MenuItem value={10}>Nintendo 64</MenuItem>
                            <MenuItem value={30}>Sega Master System</MenuItem>
                            <MenuItem value={10}>Sega Mega Drive / Genesis</MenuItem>
                            <MenuItem value={30}>Sega Mega Drive / Genesis</MenuItem>
                            <MenuItem value={10}>Nintendo GameCube</MenuItem>
                            <MenuItem value={20}>Nintendo Wii</MenuItem>
                            <MenuItem value={30}>Sega CD</MenuItem>
                            <MenuItem value={10}>Sega Saturn</MenuItem>
                            <MenuItem value={20}>Sega DreamCast</MenuItem>
                            <MenuItem value={30}>Play Station</MenuItem>
                            <MenuItem value={10}>Play Station 2</MenuItem>
                            <MenuItem value={20}>Play Station 3</MenuItem>
                            <MenuItem value={30}>Play Station 4</MenuItem>
                            <MenuItem value={10}>XBox</MenuItem>
                            <MenuItem value={20}>XBox 360</MenuItem>
                            <MenuItem value={30}>Xbox One</MenuItem>
                            <MenuItem value={10}>Nintendo Game & Watch / Elektronika</MenuItem>
                            <MenuItem value={20}>Nintendo Game Boy</MenuItem>
                            <MenuItem value={30}>Nintendo Game Boy Color</MenuItem>
                            <MenuItem value={10}>Nintendo Game Boy Advance</MenuItem>
                            <MenuItem value={20}>Nintendo DS</MenuItem>
                            <MenuItem value={30}>Nintendo 3DS</MenuItem>
                            <MenuItem value={10}>Nintendo Switch</MenuItem>
                            <MenuItem value={20}>Sega Game Gear</MenuItem>
                            <MenuItem value={30}>Play Station Portable</MenuItem>
                            <MenuItem value={10}>Play Station Vita</MenuItem>
                            <MenuItem value={20}>Kiti</MenuItem>
                        </Select>
                </FormControl>
            </div>
            <div class="input-field col s6">
                <FormControl>
                    <InputLabel id="demo-simple-select-label">Žanras</InputLabel>
                        <Select
                            labelId="demo-simple-select-label"
                            id="demo-simple-select"
        
                        >
                            <MenuItem value={10}>Veiksmas</MenuItem>
                            <MenuItem value={20}>Nuotykiai</MenuItem>
                            <MenuItem value={30}>Rolės</MenuItem>
                            <MenuItem value={10}>Simuliacija</MenuItem>
                            <MenuItem value={20}>Strategija</MenuItem>
                            <MenuItem value={30}>Sportas</MenuItem>
                            <MenuItem value={10}>Galvosūkis</MenuItem>
                        </Select>
                </FormControl>
            </div>
            <div class="input-field col s6">
                <FormControl>
                    <InputLabel id="demo-simple-select-label">Metai</InputLabel>
                        <Select
                            labelId="demo-simple-select-label"
                            id="demo-simple-select"
        
                        >
                            <MenuItem value={10}>1977</MenuItem>
                            <MenuItem value={20}>1978</MenuItem>
                            <MenuItem value={30}>1979</MenuItem>
                            <MenuItem value={10}>1980</MenuItem>
                            <MenuItem value={20}>1981</MenuItem>
                            <MenuItem value={30}>1982</MenuItem>
                            <MenuItem value={10}>1983</MenuItem>
                            <MenuItem value={20}>1984</MenuItem>
                            <MenuItem value={30}>1985</MenuItem>
                            <MenuItem value={10}>1986</MenuItem>
                            <MenuItem value={20}>1987</MenuItem>
                            <MenuItem value={30}>1988</MenuItem>
                            <MenuItem value={10}>1989</MenuItem>
                            <MenuItem value={20}>1990</MenuItem>
                            <MenuItem value={30}>1991</MenuItem>
                            <MenuItem value={10}>1992</MenuItem>
                            <MenuItem value={20}>1993</MenuItem>
                            <MenuItem value={30}>1994</MenuItem>
                            <MenuItem value={10}>1995</MenuItem>
                            <MenuItem value={20}>1996</MenuItem>
                            <MenuItem value={30}>1997</MenuItem>
                            <MenuItem value={10}>1998</MenuItem>
                            <MenuItem value={20}>1999</MenuItem>
                            <MenuItem value={30}>2000</MenuItem>
                            <MenuItem value={10}>2001</MenuItem>
                            <MenuItem value={20}>2002</MenuItem>
                            <MenuItem value={30}>2003</MenuItem>
                            <MenuItem value={20}>2004</MenuItem>
                            <MenuItem value={30}>2005</MenuItem>
                            <MenuItem value={10}>2006</MenuItem>
                            <MenuItem value={20}>2007</MenuItem>
                            <MenuItem value={30}>2008</MenuItem>
                            <MenuItem value={10}>2009</MenuItem>
                            <MenuItem value={20}>2010</MenuItem>
                            <MenuItem value={30}>2011</MenuItem>
                            <MenuItem value={10}>2012</MenuItem>
                            <MenuItem value={20}>2013</MenuItem>
                            <MenuItem value={30}>2014</MenuItem>
                            <MenuItem value={10}>2015</MenuItem>
                            <MenuItem value={20}>2016</MenuItem>
                            <MenuItem value={30}>2017</MenuItem>
                            <MenuItem value={10}>2018</MenuItem>
                            <MenuItem value={20}>2019</MenuItem>
                            <MenuItem value={30}>2020</MenuItem>
                        </Select>
                </FormControl>
            </div>
            <div class="input-field col s6">
                <FormControl>
                    <InputLabel id="demo-simple-select-label">Būsena</InputLabel>
                        <Select
                            labelId="demo-simple-select-label"
                            id="demo-simple-select"
        
                        >
                            <MenuItem value={10}>★★★★★</MenuItem>
                            <MenuItem value={20}>★★★★</MenuItem>
                            <MenuItem value={30}>★★★</MenuItem>
                            <MenuItem value={10}>★★</MenuItem>
                            <MenuItem value={20}>★</MenuItem>
                        </Select>
                </FormControl>
            </div>
            <div className="input-field col s6">
                    <input 
                        placeholder="Leidėjas" 
                        className="newHabit-input"     
                        />
                </div>
            <div className="input-field col s6">
                <input 
                    placeholder="Kaina" 
                    className="newHabit-input"
                    />
            </div>
            <div className="input-field col s12">
                <input 
                    placeholder="Komentaras" 
                    className="newHabit-input"     
                    />
            </div>
        </div>
    );
}

//  value={format}
// onChange={handleChange}

export default Form;