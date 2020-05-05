import React, { useState } from 'react';
import { useSpring, animated } from 'react-spring';

const Bundle = (props) => {

const [state, toggle] = useState(true)
const { x } = useSpring({ from: { x: 0 }, x: state ? 1 : 0, config: { duration: 1000 } })

    return (
        <div className="col s2" onClick={() => {props.selectBundle(props.bundle.id), toggle(!state)}}>
            <animated.div
                style={{
                opacity: x.interpolate({ range: [1, 1], output: [1, 1] }),
                transform: x
                    .interpolate({
                        range: [0, 0.25, 0.35, 0.45, 0.55, 0.65, 0.75, 1],
                        output: [1, 0.97, 0.9, 1.1, 0.9, 1.1, 1.03, 1]
                    })
                    .interpolate(x => `scale(${x})`)
                }}>
                    <div className={props.bundle.id === props.selectedBundle ? "selectedBundle" : "bundle"}>
                        {props.bundle.name}
                        {props.bundle.format}
                        {props.bundle.listed ? "Paskelbtas" : "Nepaskelbtas"}
                    </div>
            </animated.div>         
        </div>
    );
}

export default Bundle;