import { useContext, useEffect, useRef } from 'react';
import { attsContext } from '.';
import { dispatch } from '@wordpress/data';
import { __ } from '@wordpress/i18n';
import { SelectControl, TextControl } from '@wordpress/components';

const Agent = ({ agent, all }) => {
    const { attributes, setAttributes } = useContext(attsContext);
    const { agents } = attributes;
    const { order, agentId, role, phone, mail } = agent;

    const telInput  = useRef();
    const mailInput = useRef(); 
    
    const validatePhone = value => {
        return /^(\+?[0-9]{1,3}\s?)\(?([0-9]{3})\)?[\s.-]?[0-9]{3}[\s.-]?[0-9]{4}$/.test(value);
    }

    const validateEmail = value => {
        return /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(value);
    }

    useEffect(() => {
        if (phone === "" || validatePhone(phone)) {
            telInput.current.classList.remove('error');
            dispatch('core/editor').unlockPostSaving('invalid-phone');
        } else {
            telInput.current.classList.add('error');
            dispatch('core/editor').lockPostSaving('invalid-phone');
        }
    }, [phone]);

    useEffect(() => {
        if (mail === "" || validateEmail(mail)) {
            mailInput.current.classList.remove('error');
            dispatch('core/editor').unlockPostSaving('invalid-mail');
        } else {
            mailInput.current.classList.add('error');
            dispatch('core/editor').lockPostSaving('invalid-mail');
        }
    },[mail]);

    return ( 
        <div className="itre-editor-agents__agent">
            <SelectControl
                label={__("Select Agent")}
                value={ agentId }
                onChange={value => {
                    const newAgents = agents.map(item => {
                        return item['order'] === order ? {...item, agentId: value} : item;
                    });
                    setAttributes({ agents: newAgents })
                }}
            >
                <option value={0}>–Select–</option>
                {
                    all !== null &&
                    all.map(item => (
                        <option value={item['id']}>{item['title'].rendered}</option>
                    ))
                }

            </SelectControl>

            <TextControl
                label={__("Role")}
                placeholder="Agent"
                value={role}
                onChange={value => {
                    const newAgents = agents.map(item => {
                        return item['order'] === order ? {...item, role: value} : item;
                    });

                    setAttributes({agents: newAgents});
                }}
            />

            <TextControl
                ref={telInput}
                label={__("Phone")}
                placeholder="+1 123-456-7890"
                type="tel"
                value={phone}
                onChange={value => {
                    const newAgents = agents.map(item => {
                        return item['order'] === order ? {...item, phone: value} : item;
                    });

                    setAttributes({agents: newAgents});
                }}
            />

            <TextControl
                ref={mailInput}
                label={__("Mail")}
                type="email"
                value={mail}
                placeholder={__("abc@example.com")}
                onChange={value => {
                    const newAgents = agents.map(item => {
                        return item['order'] === order ? {...item, mail: value} : item;
                    });

                    setAttributes({agents: newAgents})
                }}
            />
        </div>
    );
}
 
export default Agent;