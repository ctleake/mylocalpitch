<?php
// src/AppBundle/Controller/PitchController.php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use FOS\RestBundle\View\View;
use AppBundle\Entity\Pitch;

use AppBundle\Entity\Slot;

class PitchController extends FOSRestController
{

    /**
     * @Rest\Get("/pitches")
     */
    public function getPitchesAction(Request $request)
    {
        $pitches = $this->getDoctrine()->getRepository('AppBundle:Pitch')->findAll();

        $restpitches = array();

        foreach ($pitches as $pitch)
        {
            if (isset($pitch)) {
                $restpitches[] = array(
                    'type' => $pitch->getType(),
                    'id' => $pitch->getId(),
                    'atttributes' => $pitch->getAttributes(),
                );
            }
        }
        if (empty($restpitches)) {
            return new View("there are no existing pitches", Response::HTTP_NOT_FOUND);
        }
        return $restpitches;
    }

    /**
     * @Rest\Get("/pitches/{pitchId}")
     */
    public function getPitchesByIdAction(Request $request)
    {
        $pitchId = $request->get('pitchId');

        $pitch = $this->getDoctrine()->getRepository('AppBundle:Pitch')->find($pitchId);

        $restpitch = array();

        if (isset($pitch)) {
            $restpitch = array(
                'type' => $pitch->getType(),
                'id' => $pitch->getId(),
                'atttributes' => $pitch->getAttributes(),
            );
        }
        if (empty($restpitch)) {
            return new View("there is no such pitch", Response::HTTP_NOT_FOUND);
        }
        return $restpitch;
    }

    /**
     * @Rest\Get("/pitches/{pitchId}/slots")
     */
    public function getSlotsByPitchIdAction(Request $request)
    {
        $pitchId = $request->get('pitchId');

        $pitchobj = $this->getDoctrine()->getRepository('AppBundle:Pitch')->find($pitchId);

        $slots = $pitchobj->getSlot()->toArray();

        $restslots = array();

        foreach ($slots as $slot)
        {
            if (isset($slot)) {
                $restslots[] = array(
                    'type' => $slot->getType(),
                    'id' => $slot->getId(),
                    'atttributes' => $slot->getAttributes(),
                );
            }
        }
        if (empty($restslots)) {
            return new View("there are no slots for this pitch", Response::HTTP_NOT_FOUND);
        }
        return $restslots;
    }

    /**
     * @Rest\Post("/pitches")
     */
    public function postPitchesAction(Request $request)
    {
        $data = ['postPitchesAction' => 'not implemented yet'];
        $view = $this->view($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        return $view;
    }

    /**
     * @Rest\Post("/pitches/{pitchId}/slots")
     */
    public function postSlotsByPitchIdAction(Request $request)
    {
        $pitchId = $request->get('pitchId');
        $all_attributes = json_decode(urldecode($request->get('attributes')));
        if (empty($all_attributes))
        {
            return new View("slots must have attributes", Response::HTTP_NOT_ACCEPTABLE);
        }

        $sn = $this->getDoctrine()->getManager();
        $pitchobj = $this->getDoctrine()->getRepository('AppBundle:Pitch')->find($pitchId);

        $slots = $pitchobj->getSlot()->toArray();

        foreach ($all_attributes as $attributes) {
            $slot = new Slot;
            $slot->setType('slots');
            $slot->setAttributes((array) $attributes);
            $sn->persist($slot);
            array_push($slots, $slot);
        }
        $pitchobj->setSlot($slots);
        $sn->persist($pitchobj);
        $sn->flush();

        if (empty($slots)) {
            return new View("no slots were added to this pitch", Response::HTTP_NOT_FOUND);
        }
        return $slots;

    }

    /**
     * @Rest\Put("/pitches/{pitchId}")
     */
    public function putPitchesByIdAction(Request $request)
    {
        $pitchId = $request->get('pitchId');
        $data = ['putPitchesByIdAction' => 'not implemented yet'];
        $view = $this->view($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        return $view;
    }

    /**
     * @Rest\Delete("/pitches/{pitchId}")
     */
    public function deletePitchesByIdAction(Request $request)
    {
        $pitchId = $request->get('pitchId');
        $data = ['deletePitchesByIdAction' => 'not implemented yet'];
        $view = $this->view($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        return $view;
    }

}