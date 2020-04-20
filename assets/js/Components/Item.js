import React, { useState } from 'react';

const Item = (props) => {
    return (
        <div className="col s6">
            <div className="item">
                {props.item.title}
                {props.item.format}
            </div>
        </div>
    );
}

export default Item;