import React, { useState } from 'react';

const Bundle = (props) => {
    return (
        <div className="col s2" onClick={() => props.selectBundle(props.bundle.id)}>
            <div className={props.bundle.id === props.selectedBundle ? "selectedBundle" : "bundle"}>
                Bundle
                {props.bundle.name}
                {props.bundle.format}
            </div>
        </div>
    );
}

export default Bundle;